<?php

namespace App\Livewire;

use App\Http\Controllers\LikeController;
use App\Models\Post;
use Livewire\Component;

class LikeButton extends Component
{
    public $post;
    public $liked;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->liked = auth()->user()->likedPosts()->where('post_id', $post->id)->where('liked', true)->exists();
    }

    public function like()
    {
        $controller = new LikeController();
        $controller->likePost($this->post);

        $this->liked = !$this->liked;
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
