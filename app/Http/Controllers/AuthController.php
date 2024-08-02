<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function authenticateToken(Request $request)
    {
        // Retrieve the authenticated user based on the provided token
        $user = auth()->user();

        if ($user) {
            return response()->json([
                'valid' => true,
                'user_id' => $user->id,
                'username' => $user->username,
            ]);
        }

        return response()->json(['valid' => false], 401);
    }
}
