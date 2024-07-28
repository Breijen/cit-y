<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;

use App\Http\Controllers\ActivityController;

use App\Http\Controllers\ExploreController;

use App\Models\Post;

Auth::routes(['verify' => true]);

Route::get('/', [PostController::class, 'index']);

//Laat profiel zien
Route::get('/profile/{username}', [UserController::class, 'show'])->middleware(['auth', 'verified']);

//Laat een enkele post zien
Route::get('/{username}/{uuid}', [PostController::class, 'show']);

//Laat quote zien
Route::get('/api/posts/uuid/{uuid}', function ($uuid) {
    $post = Post::where('uuid', $uuid)->with('user')->firstOrFail();
    return [
        'id' => $post->id,
        'content' => $post->content,
        'user' => [
            'username' => $post->user->username,
            'profile_picture' => $post->user->profile_picture
        ],
        'image_one' => $post->image_one,
        'created_at' => $post->created_at,
    ];
});

//Verzend een post
Route::post('/posts', [PostController::class, 'store'])->middleware(['auth', 'verified']);

//Edit een post
Route::put('/posts/{post}', [PostController::class,'update'])->middleware(['auth', 'verified']);
//Verwijder een post
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->middleware(['auth', 'verified']);

//Comment Posten
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->middleware(['auth', 'verified'])->name('comments.store');

//Edit een comment
Route::put('/posts/{post}/comments/{comment}', [CommentController::class, 'update'])->middleware(['auth', 'verified']);

//Verwijder een comment
Route::delete('/posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])->middleware(['auth', 'verified']);

//Comment ontvangen
Route::get('/posts/{post}/comments', [CommentController::class, 'index'])->name('comments.index');

//Registratieformulier
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

//Bewaar nieuwe gebruikers
Route::post('/users', [UserController::class, 'store']);

//Log in form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//Log gebruiker in
Route::post('/users/authenticate', [UserController::class, 'authenticate'])->middleware('guest');

//Log gebruiker uit
Route::post('/logout', [UserController::class, 'logout']);

//Update Profile
Route::put('/users/{user}', [UserController::class, 'update'])->middleware(['auth', 'verified'])->name('profile.update');

//Likes
Route::post('/like/posts/{post}', [LikeController::class, 'likePost'])->name('likePost');
Route::post('/like/comments/{comment}', [LikeController::class, 'likeComment'])->name('likeComment');

//Volgen en ontvolgen
Route::post('/follow/{user}', [FollowController::class, 'follow'])->name('follow');
Route::post('/unfollow/{user}', [FollowController::class, 'unfollow'])->name('unfollow');

Route::get('/activity', [ActivityController::class, 'index'])->name('activity.index')->middleware(['auth', 'verified']);

Route::get('/explore', [ExploreController::class, 'searchRecent'])->name('explore.search');

// EMAIL VERIFICATIE

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
