<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Quote;
use App\Models\Poll;
use App\Models\PollOption;
use App\Models\PollVote;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //Laat alle posts zien
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->with('user', 'comments.user')->get()->map(function ($post) {
            return $post;
        });


        return view('posts.index', ['posts' => $posts]);
    }

    // Show a single post with comments
    public function show($username, $uuid)
    {
        $post = Post::where('uuid', $uuid)
            ->with('user', 'comments.user')
            ->firstOrFail();
        $comments = $post->comments()->with(['user'])->get()->map(function ($comment) {
            $comment->isLikedByUser = auth()->user() ? $comment->likedBy->contains(auth()->id()) : false;
            return $comment;
        });

        if ($post->user->username !== $username) {
            abort(404);
        }

        return view('posts.show', compact('post', 'comments'));
    }

    public function showQuote($id) {
        $post = Post::with(['user', 'quote.quotedPost.user'])->findOrFail($id);

        return view('posts.quote', compact('post'));
    }

    public function store(Request $request)
    {
        //Content dat gevuld kan worden

        // Validate content and image
        $validatedData = $request->validate([
            'content' => 'required|string',
            'image_one' => 'nullable|image',
            'quote_id' => 'nullable|exists:posts,id',
            'pollToggle' => 'nullable',
            'options' => 'required_if:pollToggle,on|array|max:6', 
            'options.*' => 'required_if:pollToggle,on|string|max:255'
        ]);


        // Standaard variabelen

        $formFields = array_merge([
            'username' => auth()->user()->username,
            'uuid' => uniqid(),
            'likes' => 0,
            'reposts' => 0,
            'shares' => 0,
            'timestamp' => date("Y-m-d H:i:s"),
        ], $validatedData);

        // Handle the image upload
        if ($request->hasFile('image_one')) {
            $file = $request->file('image_one');
            $path = $file->store('image_one', 'public');
            $formFields['image_one'] = $path;
        }

        $formFields['user_id'] = auth()->id();
        $post = Post::create($formFields);

        // Handle the quote_id if present
        if (!empty($validatedData['quote_id'])) {
            Quote::create([
                'post_id' => $post->id,
                'quote_id' => $validatedData['quote_id'],
            ]);
        }

        // Handle poll creation if pollToggle is enabled
        if ($request->input('pollToggle') === 'on') {
            $poll = Poll::create([
                'post_id' => $post->id,
                'question' => 'Poll Question', // Adjust as needed
            ]);

            foreach ($validatedData['options'] as $option) {
                PollOption::create([
                    'poll_id' => $poll->id,
                    'option_text' => $option,
                ]);
            }
        }

        return back();
    }

    // Store a new comment
    public function storeComment(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment = new Comment([
            'content' => $validatedData['content'],
            'user_id' => auth()->id(),
        ]);

        $post->comments()->save($comment);

        return redirect()->back();
    }

    public function update(Request $request, Post $post) {

        if($post->user_id != auth()->id()) {
            abort(403, 'Unauthorized action');
        }

        $formData = $request->validate([
            'content' => 'required|string',
        ]);

        $post->update($formData);

        return redirect('/');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id != auth()->id()) {
            abort(403, 'Unauthorized action');
        }

        $post->delete();

        return redirect('/');
    }
}
