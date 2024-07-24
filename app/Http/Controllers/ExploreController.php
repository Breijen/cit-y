<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use SebastianBergmann\Environment\Console;

class ExploreController extends Controller
{
    public function searchRecent(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $posts = Post::where('content', 'like', '%' . $search . '%')->get();
        } else {
            $posts = collect(); // Empty collection if no search term
        }

        return view('explore.index', compact('posts', 'search'));
    }
}
