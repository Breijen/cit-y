<div class="h-auto">
    <div class="space-y-2 w-full max-w-4xl mx-auto p-4 bg-content_bg rounded-lg border border-divider">
        @if($user->posts->count() > 0)
            @foreach($user->posts->sortByDesc('created_at') as $post)
                @include("components.posts._post")
            @endforeach
        @else
            <div class="text-placeholder flex items-center justify-center w-full ">
                <p>No posts made yet!</p>
            </div>
        @endif
    </div>
</div>

@auth
    @include("components.posts._create_comment_modal")
    @include("components.comments._edit_comment_modal")
    @include("components.comments._delete_comment_modal")
@endauth
