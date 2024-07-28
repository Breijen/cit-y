<div class="h-auto">
    <div class="space-y-2 w-full max-w-4xl mx-auto p-4 bg-content_bg rounded-lg border border-divider">
        <p class="pl-2 text-xs text-placeholder">pinned post</p>
        @if(auth()->user()->pinnedPost)
            @include("components.posts._post", ['post' => auth()->user()->pinnedPost])
        @endif
    </div>
</div>
