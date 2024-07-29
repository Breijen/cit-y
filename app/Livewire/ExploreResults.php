<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\User;

class ExploreResults extends Component
{
    public $search = '';
    protected $queryString = ['search'];

    public function render()
    {
        if ($this->search) {
            if (strpos($this->search, '@') === 0) {
                $username = substr($this->search, 1); // Remove the '@' from the beginning
                $users = User::where('username', 'like', '%' . $username . '%')->get();
                $posts = collect(); // Empty collection for posts
            } else {
                $posts = Post::where('content', 'like', '%' . $this->search . '%')->get();
                $users = collect(); // Empty collection for users
            }
        } else {
            $posts = Post::latest()->get(); // Get recent posts if no search term
            $users = collect(); // Empty collection for users
        }

        return view('livewire.explore-results', compact('posts', 'users'));
    }
}
