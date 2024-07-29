@vite('resources/css/app.css')
@vite('resources/js/app.js')

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @php
            $pageName = 'Profile';
        @endphp

        <title>Cit-Y</title>

        @vite('resources/css/app.css')
            
    </head>
    <body class="bg-background">
        @include("components._header")

        @auth
            @include("components.alerts._shared")
            @include("components.alerts._pinned")
            @include("components._create_post")
            @include("components.posts._create_post_modal")
        @endauth   

        <div class="flex">
        @include("components._sidebar")



        <main class="flex-1 pt-4 rounded-3xl">
        @if(auth()->user()->isBlockedBy($user))
            <div class="max-w-4xl mx-auto h-auto bg-content_bg rounded-3xl mb-32 border border-divider relative">
                <div class="flex justify-center items-center font-bold p-4">
                    <p class="text-white s">You have been blocked</p>
                </div>
            </div>
        @else    
        @include("components.profile._main")
        @endif
        </main>
        </div>

    </body>
</html>
