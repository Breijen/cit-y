<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PollVote;
use App\Models\PollOption;

class PollController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $poll = $post->poll()->create([
            'question' => $request->input('question')
        ]);

        foreach ($request->input('options') as $option) {
            $poll->options()->create(['option_text' => $option]);
        }

        return redirect()->back()->with('status', 'Poll created successfully');
    }

    public function vote(Request $request, PollOption $pollOption)
    {
        $user = auth()->user();

        // Ensure user hasn't voted already
        if (PollVote::where('user_id', $user->id)->where('poll_option_id', $pollOption->id)->exists()) {
            return back()->withErrors(['message' => 'You have already voted']);
        }

        // Save the vote
        PollVote::create([
            'user_id' => $user->id,
            'poll_option_id' => $pollOption->id,
        ]);

        return back()->with('success', 'Vote recorded successfully');
    }
}
