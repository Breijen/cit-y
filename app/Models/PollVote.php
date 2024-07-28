<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollVote extends Model
{
    use HasFactory;

    protected $fillable = ['poll_option_id', 'user_id'];

    public function option()
    {
        return $this->belongsTo(PollOption::class);
    }
}
