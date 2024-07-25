<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use SebastianBergmann\Environment\Console;

class ExploreController extends Controller
{
    public function searchRecent(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            if (strpos($search, '@') === 0) {
                // Zoek naar gebruikers als de zoekterm begint met '@'
                $username = substr($search, 1); // Verwijder de '@' van het begin
                $users = User::where('username', 'like', '%' . $username . '%')->get();
                $posts = collect(); // Lege collectie voor berichten
            } else {
                // Zoek naar berichten als de zoekterm niet begint met '@'
                $posts = Post::where('content', 'like', '%' . $search . '%')->get();
                $users = collect(); // Lege collectie voor gebruikers
            }
        } else {
            $posts = collect(); // Lege collectie als er geen zoekterm is
            $users = collect(); // Lege collectie als er geen zoekterm is
        }

        return view('explore.index', compact('posts', 'users', 'search'));
    }
}
