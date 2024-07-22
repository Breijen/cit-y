<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {

        $validatedData = $request->validate([
            'content' => 'required|string',
            'comment_image_one' => 'nullable|image', // Add image validation
        ]);

        $formFields = array_merge($validatedData, [
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'likes' => 0,
        ]);

        // Handle the image upload
        if ($request->hasFile('comment_image_one')) {
            $file = $request->file('comment_image_one');

            $path = $file->store('comment_image_one', 'public');

            $formFields['comment_image_one'] = $path;
        }

        Comment::create($formFields);

        return back();
    }

    public function index(Post $post)
    {
        $comments = $post->comments()->with('user')->get();

        return response()->json($comments);
    }

    public function update(Request $request, Post $post, Comment $comment)
    {

        if ($comment->user_id != auth()->id()) {
            abort(403, 'Unauthorized action');
        }

        $formData = $request->validate([
            'content' => 'required|string',
        ]);

        $comment->update($formData);

        return back();
    }

    public function destroy(Post $post, Comment $comment)
    {
        if ($comment->user_id != auth()->id()) {
            abort(403, 'Unauthorized action');
        }

        $comment->delete();

        return back();
    }
}
