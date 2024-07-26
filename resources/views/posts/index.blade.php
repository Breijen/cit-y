@extends('layout')

@section('content')
    @auth    
    @include("components.posts._create_post")
    @endauth   

    <div class="min-h-screen">
        <div class="space-y-2 w-full max-w-4xl mx-auto p-4 bg-content_bg rounded-3xl border border-divider">
            @foreach($posts->sortByDesc('created_at') as $post)
                @include("components.posts._post")
                @if($posts->count() > 0)
                    @auth
                        @include("components.posts._create_comment_modal")
                        @include("components.posts._edit_post_modal")
                        @include("components.posts._delete_post_modal")
                    @endauth
                @endif
            @endforeach    
        </div>
    </div>

@endsection

