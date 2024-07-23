@extends('layout')

@section('content')
    @auth    
    @include("components.posts._create_post")
    @endauth   

    <div class="min-h-screen">
        <div class="space-y-2 w-full max-w-4xl mx-auto p-4 bg-content_bg rounded-lg border border-divider">
            @foreach($posts as $post)
                @include("components.posts._post")
            @endforeach    
        </div>
    </div>

    @auth
    @include("components.posts._edit_post_modal")
    @include("components.posts._delete_post_modal")
    @endauth

    <script type="text/javascript">
        function passContent(content, id) {
            event.stopPropagation();

            document.getElementById('postEditForm').action = "/posts/" + id;
            document.getElementById('postDeleteForm').action = "/posts/" + id;
            document.getElementById('postEditInput').value = content;
        }

        function passPost(id) {
            event.stopPropagation();
            document.getElementById('createCommentForm').action = "/posts/" + id + "/comments";
        }
    </script>
@endsection

