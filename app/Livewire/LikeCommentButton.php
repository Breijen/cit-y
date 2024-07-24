<?php

namespace App\Livewire;

use App\Http\Controllers\LikeController;
use App\Models\Comment;
use Livewire\Component;

class LikeCommentButton extends Component
{
    public $comment;
    public $liked;

    public function mount(Comment $comment)
    {
        $this->comment = $comment;
        $this->liked = auth()->user()->likedComments()->where('comment_id', $comment->id)->where('liked', true)->exists();
    }

    public function like()
    {
        $controller = new LikeController();
        $controller->likeComment($this->comment);

        $this->liked = !$this->liked;
    }
    public function render()
    {
        return view('livewire.like-comment-button');
    }
}
