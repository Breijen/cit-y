
<div id="results" class="space-y-2 w-full max-w-4xl mx-auto p-4 bg-content_bg rounded-3xl border border-divider">
    @if($search && strpos($search, '@') === 0)
        @if($users->isNotEmpty())
            <ul class="list-group">
                @foreach($users as $user)
                    @include("components.search._profile_card")
                @endforeach
            </ul>
        @else
        <div class="flex justify-center items-center"> 
            <p class="text-placeholder">No users found</p>
        </div>
        @endif
    @else
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
    @endif
</div>
