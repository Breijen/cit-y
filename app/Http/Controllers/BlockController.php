<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class BlockController extends Controller
{
    public function block(User $user)
    {
        $authUser = auth()->user();
        if ($authUser->id === $user->id) {
            return redirect()->back()->with('error', 'You cannot block yourself.');
        }

        if (!$authUser->hasBlocked($user)) {
            $authUser->block($user);

            // Unfollow the user if currently following
            if ($authUser->following->contains($user)) {
                app(FollowController::class)->unfollow($user);
            }

            // Remove the user from the followers list if currently followed
            if ($authUser->followers->contains($user)) {
                $user->unfollow($authUser);
            }

            return redirect()->back()->with('success', 'User blocked successfully.');
        }

        return redirect()->back()->with('error', 'User is already blocked.');
    }

    public function unblock(User $user)
    {
        $authUser = auth()->user();
        if ($authUser->hasBlocked($user)) {
            $authUser->unblock($user);
            return redirect()->back()->with('success', 'User unblocked successfully.');
        }

        return redirect()->back()->with('error', 'User is not blocked.');
    }
}
