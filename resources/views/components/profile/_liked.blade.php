<div class="h-auto">
    <div class="space-y-2 w-full max-w-4xl mx-auto p-4 bg-content_bg rounded-lg border border-divider">
        @if($user->likedPosts->count() > 0)
            @foreach($user->likedPosts as $post)
                @include("components.posts._post")
            @endforeach
        @else
            <div class="text-placeholder flex items-center justify-center w-full">
                <p>No posts liked yet!</p>
            </div>
        @endif
    </div>
</div>
