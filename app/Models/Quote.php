<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
