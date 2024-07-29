<div>
    <div class="max-w-4xl p-8 mx-auto h-auto bg-content_bg rounded-3xl mb-4 border border-divider relative">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
    <input wire:model.live="search" type="search" autocomplete="off" class="block w-full outline-none p-4 pl-10 text-sm text-white rounded-lg bg-background focus:border focus:border-liked_by " placeholder="Explore Posts, @citizens..." required>    </div>
    </div>

    <div id="results" class="space-y-2 w-full max-w-4xl mx-auto p-4 bg-content_bg rounded-3xl border border-divider">
        @auth
        @if($search && strpos($search, '@') === 0)
            @if($users->isNotEmpty())
                <ul class="list-group">
                    @foreach($users as $user)
                        @if(!auth()->user()->isBlockedBy($user))
                            @include("components.search._profile_card", ['user' => $user])
                        @endif
                    @endforeach
                </ul>
            @else
                <div class="flex justify-center items-center"> 
                    <p class="text-placeholder">No users found</p>
                </div>
            @endif
        @else
            @if($posts->isEmpty())
                <div class="flex justify-center items-center">
                    <p class="text-placeholder">No posts found.</p>
                </div>
            @else
                <div class="flex justify-center items-center">
                    <p class="text-placeholder">Recent</p>
                </div>
                @foreach($posts->sortByDesc('created_at') as $post)
                    @include("components.posts._post", ['post' => $post])
                @endforeach
                @auth
                    @include("components.posts._create_comment_modal")
                    @include("components.posts._edit_post_modal")
                    @include("components.posts._delete_post_modal")
                @endauth
            @endif
        @endif
        @endauth

        @guest
            @if($search && strpos($search, '@') === 0)
            @if($users->isNotEmpty())
                <ul class="list-group">
                    @foreach($users as $user)
                        @include("components.search._profile_card", ['user' => $user])
                    @endforeach
                </ul>
            @else
                <div class="flex justify-center items-center"> 
                    <p class="text-placeholder">No users found</p>
                </div>
            @endif
        @else
            @if($posts->isEmpty())
                <div class="flex justify-center items-center">
                    <p class="text-placeholder">No posts found.</p>
                </div>
            @else
                <div class="flex justify-center items-center">
                    <p class="text-placeholder">Recent</p>
                </div>
                @foreach($posts->sortByDesc('created_at') as $post)
                    @include("components.posts._post", ['post' => $post])
                @endforeach
                @auth
                    @include("components.posts._create_comment_modal")
                    @include("components.posts._edit_post_modal")
                    @include("components.posts._delete_post_modal")
                @endauth
            @endif
        @endif
        @endguest
    </div>
</div>
