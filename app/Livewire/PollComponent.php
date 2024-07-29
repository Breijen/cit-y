<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\PollVote;
use Illuminate\Support\Facades\Auth;

class PollComponent extends Component
{
    public $post;
    public $poll;
    public $userVotedOption = null;
    public $totalVotes = 0;
    public $optionsWithPercentages = [];

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->loadPollData();
    }

    public function loadPollData()
    {
        $this->poll = $this->post->poll()->with('options.votes')->first();

        if ($this->poll) {
            if (auth()->check()) {
                $this->userVotedOption = PollVote::where('user_id', auth()->id())
                    ->whereIn('poll_option_id', $this->poll->options->pluck('id'))
                    ->first();
            }

            $this->totalVotes = $this->poll->options->sum(function ($option) {
                return $option->votes->count();
            });

            $this->optionsWithPercentages = $this->poll->options->map(function ($option) {
                $optionVotes = $option->votes->count();
                $percentage = $this->totalVotes > 0 ? round(($optionVotes / $this->totalVotes) * 100) : 0;
                return [
                    'option' => $option,
                    'votes' => $optionVotes,
                    'percentage' => $percentage,
                ];
            });
        }
    }

    public function votePoll($optionId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (PollVote::where('user_id', Auth::id())->where('poll_option_id', $optionId)->exists()) {
            return;
        }

        PollVote::create([
            'user_id' => Auth::id(),
            'poll_option_id' => $optionId,
        ]);

        $this->loadPollData();
    }

    public function render()
    {
        return view('livewire.poll-component', [
            'post' => $this->post,
            'poll' => $this->poll,
            'totalVotes' => $this->totalVotes,
            'optionsWithPercentages' => $this->optionsWithPercentages,
        ]);
    }
}
