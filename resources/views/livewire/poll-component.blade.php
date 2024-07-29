<div wire:poll.5000ms="loadPollData">
    @if($poll)
        <div class="space-y-2 w-full max-w-4xl mx-auto p-4 mt-4 bg-content_bg rounded-3xl border border-divider mb-4">
            @if($userVotedOption || !auth()->check())
                <div class="space-y-2">
                    @foreach($optionsWithPercentages as $option)
                        <div class="flex items-center mb-2">
                            <div class="w-full bg-content_bg border border-icons rounded-md h-10 relative">
                                <div class="bg-icons h-10 rounded-md" style="width: {{ $option['percentage'] }}%"></div>
                                <span class="absolute inset-0 flex items-center text-white pl-2 font-bold">{{ $option['option']->option_text }}</span>
                                <span class="absolute inset-0 flex items-center justify-end text-white font-bold pr-2">{{ $option['percentage'] }}%</span>
                            </div>
                        </div>
                    @endforeach
                    <p class="text-xs text-placeholder">{{ $totalVotes }} votes</p>
                </div>
            @else
                <div class="space-y-2">
                    @foreach($poll->options as $option)
                        <button class="w-full bg-content_bg border border-divider hover:bg-icons text-white font-bold py-2 rounded-md text-center" onclick="event.stopPropagation();" wire:click="votePoll({{ $option->id }})">
                            {{ $option->option_text }}
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
    @endif
</div>
