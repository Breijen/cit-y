
<div id="results" class="space-y-2 w-full max-w-4xl mx-auto p-4 bg-content_bg rounded-3xl border border-divider">
    @if(isset($posts) && $posts->isEmpty())
        <div class="flex justify-center items-center">
            <p class="text-placeholder">No posts found.</p>
        </div>
    @else
        <div class="flex justify-center items-center">
            <p class="text-placeholder">Recent</p>
        </div>
        @foreach($posts->sortByDesc('created_at') as $post)
            @include("components.posts._post")
        @endforeach
    @auth
    @include("components.posts._create_comment_modal")
    @include("components.posts._edit_post_modal")
    @include("components.posts._delete_post_modal")
    @endauth
    @endif
</div>
