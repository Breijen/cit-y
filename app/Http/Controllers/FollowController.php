<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        $currentUser = auth()->user();
        if (!$currentUser->following->contains($user)) {
            $currentUser->following()->attach($user);
        }

        return back();
    }

    public function unfollow(User $user)
    {
        $currentUser = auth()->user();
        if ($currentUser->following->contains($user)) {
            $currentUser->following()->detach($user);
        }

        return back();
    }
}
