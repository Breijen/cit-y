<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // Haal de ID van de ingelogde gebruiker op

        // Haal alle posts op met comments
        $postsWithComments = Post::whereHas('comments')->with(['user', 'comments.user'])->get();

        // Haal alle posts op met likes, exclusief de likes van de ingelogde gebruiker
        $postsWithLikes = Post::whereHas('likedBy', function ($query) use ($userId) {
            $query->where('user_id', '!=', $userId);
        })->with([
                    'user',
                    'likedBy' => function ($query) {
                        $query->orderBy('post_user_likes.created_at', 'desc');
                    }
                ])->get();

        // Combineer de twee verzamelingen
        $posts = $postsWithComments->merge($postsWithLikes);

        return view('activity.index', compact('posts'));
    }
}
