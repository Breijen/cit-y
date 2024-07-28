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
            'options' => 'array|nullable',
            'options.*' => 'string|distinct|nullable',
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

        $pollOptions = array_filter($request->input('options', []), function ($option) {
            return !is_null($option) && $option !== '';
        });

        if (count($pollOptions) > 1) {
            $poll = new Poll();
            $poll->post_id = $post->id;
            $poll->save();

            foreach ($pollOptions as $optionText) {
                $option = new PollOption();
                $option->poll_id = $poll->id;
                $option->option_text = $optionText;
                $option->save();
            }
        }

        return back();
    }

    public function pinPost(Request $request, $id)
    {
        $user = auth()->user();
        $post = Post::find($id);

        if ($post && $post->user_id == $user->id) {
            if ($request->input('pin')) {
                // Pin the selected post
                $user->pinned_post_id = $post->id;
            } else {
                // Unpin the post
                $user->pinned_post_id = null;
            }
            $user->save();

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error'], 400);
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
