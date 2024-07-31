<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\CanResetPassword;
use Laravel\Cashier\Billable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Comment;

class User extends Authenticatable // implements MustVerifyEmail
{
    use HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'email',
        'password',
        'banner',
        'profile_picture',
        'bio',
        'website',
        'hide_last_name',
        'currency_balance',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relatie met posts
    public function posts(){
        return $this->hasMany(Post::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function likedPosts()
    {
        return $this->belongsToMany(Post::class, 'post_user_likes')
            ->wherePivot('liked', true)
            ->withTimestamps();
    }

    public function likedComments()
    {
        return $this->belongsToMany(Comment::class, 'comment_user_likes')
            ->wherePivot('liked', true)
            ->withTimestamps();
    }

    public function pinnedPost()
    {
        return $this->belongsTo(Post::class, 'pinned_post_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id')->withTimestamps();
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id')->withTimestamps();
    }

    public function getFollowerCountAttribute()
    {
        return $this->followers()->count();
    }

    // Block functies

    public function blockedUsers()
    {
        return $this->belongsToMany(User::class, 'blocked_users', 'user_id', 'blocked_user_id')->withTimestamps();
    }

    public function blockers()
    {
        return $this->belongsToMany(User::class, 'blocked_users', 'blocked_user_id', 'user_id')->withTimestamps();
    }

    public function block(User $user)
    {
        $this->blockedUsers()->attach($user->id);
    }

    public function unblock(User $user)
    {
        $this->blockedUsers()->detach($user->id);
    }

    public function isBlockedBy(User $user)
    {
        return $this->blockers()->where('user_id', $user->id)->exists();
    }

    public function hasBlocked(User $user)
    {
        return $this->blockedUsers()->where('blocked_user_id', $user->id)->exists();
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }
}
