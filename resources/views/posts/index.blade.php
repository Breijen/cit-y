@extends('layout')

@section('content')
    @auth
        @include("components._create_post")
        @include("components.posts._create_post_modal")
    @endauth   

    <div class="min-h-screen">
        <div class="space-y-2 w-full max-w-4xl mx-auto p-4 bg-content_bg rounded-3xl border border-divider">
        @auth
            @if($posts->count() > 0)
                @foreach($posts->sortByDesc('created_at') as $post)
                    @if(!auth()->user()->isBlockedBy($post->user))
                        @include("components.posts._post", ['post' => $post])
                    @endif
                @endforeach
                @include("components.posts._create_comment_modal")
                @include("components.posts._edit_post_modal")
                @include("components.posts._delete_post_modal")
            @endif
        @endauth    

        @guest
            @if($posts->count() > 0)
                @foreach($posts->sortByDesc('created_at') as $post)
                    @include("components.posts._post", ['post' => $post])
                @endforeach
            @endif
        @endguest
        </div>
    </div>

@endsection

