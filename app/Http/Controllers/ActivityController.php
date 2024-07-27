<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Psy\Readline\Hoa\Console;

class ActivityController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
      
        $postsWithComments = Post::where('user_id', $userId)
            ->with([
                'comments' => function ($query) use ($userId) {
                    $query->where('user_id', '!=', $userId);
                },
                'comments.user'
            ])
            ->get();

        // Haal alle posts op met likes, exclusief de likes van de ingelogde gebruiker
        $postsWithLikes = Post::whereHas('likedBy', function ($query) use ($userId) {
            $query->where('user_id', '!=', $userId);
        })->with([
                    'user',
                    'likedBy' => function ($query) use ($userId) {
                        $query->where('user_id', '!=', $userId)->orderBy('post_user_likes.created_at', 'desc');
                    }
                ])
                ->get();

        // Retrieve posts quoted by others
        $quotedPosts = Post::where('user_id', $userId)->get();

        // Haal volgers op, exclusief de ingelogde gebruiker zelf
        $followers = auth()->user()->followers()->where('follower_id', '!=', $userId)->get();

        // Combineer en sorteer de notificaties
        $notifications = [];

        foreach ($postsWithComments as $post) {
            foreach ($post->comments as $comment) {
                $notifications[] = [
                    'post' => $post,
                    'type' => 'comment',
                    'data' => $comment,
                    'timestamp' => $comment->created_at,
                ];
            }
        }

        foreach ($postsWithLikes as $post) {
            foreach ($post->likedBy as $like) {
                $notifications[] = [
                    'type' => 'like',
                    'data' => $post,
                    'like_user' => $like,
                    'timestamp' => $like->pivot->created_at,
                ];
            }
        }

        // Add quotes notifications
        foreach ($quotedPosts as $post) {
            foreach ($post->quotedBy as $quote) {
                $notifications[] = [
                    'type' => 'quote',
                    'post' => $post,
                    'user' => $post->user,
                    'data' => $quote,
                    'timestamp' => $quote->created_at,
                ];
            }
        }

        foreach ($followers as $follower) {
            $notifications[] = [
                'type' => 'follow',
                'data' => $follower,
                'timestamp' => $follower->pivot->created_at,
            ];
        }

        // Sorteer de notificaties op timestamp
        usort($notifications, function ($a, $b) {
            return $b['timestamp'] <=> $a['timestamp'];
        });

        return view('activity.index', compact('notifications'));
    }
}
