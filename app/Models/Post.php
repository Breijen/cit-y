<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Comment;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'user_id',
        'uuid',
        'content',
        'likes',
        'reposts',
        'shares',
        'image_one',
        'timestamp'
    ];

    // Relatie tot gebruiker
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'post_user_likes')
            ->wherePivot('liked', true)
            ->withTimestamps();
    }
}
