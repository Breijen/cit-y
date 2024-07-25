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

        // Haal alle posts van de ingelogde gebruiker op met comments
        $postsWithComments = Post::where('user_id', $userId)
            ->whereHas('comments')
            ->with(['user', 'comments.user'])
            ->get();

        // Haal alle posts van de ingelogde gebruiker op met likes
        $postsWithLikes = Post::where('user_id', $userId)
            ->whereHas('likedBy')
            ->with([
                'user',
                'likedBy' => function ($query) {
                    $query->orderBy('post_user_likes.created_at', 'desc');
                }
            ])->get();

        // Haal volgers op
        $followers = auth()->user()->followers()->get();

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
