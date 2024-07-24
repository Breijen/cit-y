<div class="min-h-screen">
    <div class="space-y-2 w-full max-w-4xl mx-auto p-4 bg-content_bg rounded-lg border border-divider">
        <div class="posts">
            @foreach($posts as $post)
                @if($post->comments->count() > 0)
                    @foreach($post->comments as $comment)
                        @if($comment->user->id !== auth()->user()->id)
                        @include("components.activity._commented_by")
                      @endif
                @endforeach
                @endif
            @endforeach
            @foreach($posts as $post)
                    @if($post->likedBy->count() > 0)
                        @if($mostRecentLike = $post->likedBy->where('pivot.user_id', '!=', Auth::id())->first())
                            @include("components.activity._liked_by")
                      @endif
                @endif
            @endforeach
        </div>
    </div>
</div>


