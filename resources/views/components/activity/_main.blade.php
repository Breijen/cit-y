<div class="min-h-screen pb-20">
    <div class="space-y-2 w-full max-w-4xl mx-auto p-4 bg-content_bg rounded-3xl border border-divider">
        <div class="posts">
            @foreach($notifications as $notification)
                @if($notification['type'] == 'comment')
                    @include('components.activity._commented_by', ['comment' => $notification['data'], 'post'=> $notification['post']])
                @elseif($notification['type'] == 'like')
                    @include('components.activity._liked_by', ['post' => $notification['data'], 'mostRecentLike' => $notification['like_user']])
                @elseif($notification['type'] == 'follow')
                    @include('components.activity._followed_by', ['follower' => $notification['data']])
                @endif
            @endforeach
            <div class="flex justify-center items-center">
                <p class="text-placeholder">End of your notifications. Interact some more!</p>
            </div>
        </div>
    </div>
</div>


