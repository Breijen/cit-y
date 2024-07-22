<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\User;

class UserController extends Controller
{
    public function create(){
        return view('users.register');
    }

    public function store(Request $request)
    {
        // Validate request data
        $formFields = $request->validate([
            'firstname' => 'required|min:3',
            'lastname' => 'required|min:3',
            'email' => ['required','email', Rule::unique('users', 'email')],
            'username' => 'required|string|min:3',
            'password' => 'required|confirmed|min:8'
            // other validation rules
        ]);

        // Has Password

        $formFields['password'] = bcrypt($formFields['password']);
        $formFields['bio'] = null;
        $formFields['website'] = null;
        $formFields['followers'] = 0;
        $formFields['following'] = 0;

        // Maak de gebruiker aan
        $user = User::create($formFields);

        auth()->login($user);

        return redirect('/');
    }

    public function authenticate(Request $request){
        $formFields = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
            // other validation rules
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

        
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function login(Request $request)
    {
        return view('users.login');
    }

    public function show($username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            abort(403, "User not found");
        }

        $posts = Post::where('user_id', $user->id)
            ->where('created_at', '>=', date("Y-m-d h:i:sa"))
            ->orderBy('created_at', 'desc')
            ->get()->map(function ($post) {
            $post->isLikedByUser = auth()->user() ? $post->likedBy->contains(auth()->id()) : false;
            return $post;
        });

        return view('users.profile', compact('posts', 'user'));
    }

    public function update(Request $request, User $user)
    {
        \Log::info('Received request...');

        // Validate the incoming request data
        $formData = $request->validate([
            'bio' => 'nullable|string',
            'website' => 'nullable|string|url',
        ]);

        // Handle banner file upload
        if ($request->hasFile('banner')) {
            try {
                $formData['banner'] = $request->file('banner')->store('banners', 'public');
                \Log::info('Banner stored successfully: ' . $formData['banner']);
            } catch (\Exception $e) {
                \Log::error('Error storing banner: ' . $e->getMessage());
            }
        }

        // Handle profile picture file upload
        if ($request->hasFile('profile_picture')) {
            try {
                $formData['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
                \Log::info('Profile picture stored successfully: ' . $formData['profile_picture']);
            } catch (\Exception $e) {
                \Log::error('Error storing profile picture: ' . $e->getMessage());
            }
        }

        // Update the user's information
        \Log::info('Updating user information...');
        $user->update($formData);

        \Log::info('User information updated successfully:', $user->toArray());

        // Redirect back to the previous page
        return back();
    }
}
