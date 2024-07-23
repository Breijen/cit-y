<div class="h-auto">
    <div class="space-y-2 w-full max-w-4xl mx-auto p-4 bg-content_bg rounded-lg border border-divider">
        @if($user->comments->count() > 0)
            @foreach($user->comments->sortByDesc('created_at') as $comment)
                @include("components.comments._comment")
            @endforeach
        @else
            <div class="text-placeholder flex items-center justify-center w-full">
                <p>No comments made yet!</p>
            </div>
        @endif
    </div>
</div>

@auth
    @include("components.posts._edit_post_modal")
    @include("components.posts._delete_post_modal")
@endauth
