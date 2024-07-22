<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;

class LikeController extends Controller
{
    public function likePost(Post $post)
    {
        $user = auth()->user();

        // Check if the user has already liked the post
        if ($user->likedPosts()->where('post_id', $post->id)->exists()) {
            // Decrement the likes count on the post
            $user->likedPosts()->syncWithoutDetaching([$post->id => ['liked' => false]]);

            $post->decrement('likes');
        } else {
            // Like the post
            $user->likedPosts()->syncWithoutDetaching([$post->id => ['liked' => true]]);

            // Increment the likes count on the post
            $post->increment('likes');
        }

        return back();
    }

    public function likeComment(Comment $comment)
    {
        $user = auth()->user();

        // Check if the user has already liked the post
        if ($user->likedComments()->where('comment_id', $comment->id)->exists()) {
            // Decrement the likes count on the post
            $user->likedComments()->syncWithoutDetaching([$comment->id => ['liked' => false]]);

            $comment->decrement('likes');
        } else {
            // Like the post
            $user->likedComments()->syncWithoutDetaching([$comment->id => ['liked' => true]]);

            // Increment the likes count on the post
            $comment->increment('likes');
        }

        return back();
    }
}
