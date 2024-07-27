<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Post;
use App\Models\User;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_id',
        'post_id',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function quotedPost()
    {
        return $this->belongsTo(Post::class, 'quote_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function postUser()
    {
        return $this->hasOneThrough(User::class, Post::class, 'id', 'id', 'post_id', 'user_id');
    }
}
