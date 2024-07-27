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
            @include("components._create_post")
            @include("components.posts._create_post_modal")
        @endauth   

        <div class="flex">
        @include("components._sidebar")



        <main class="flex-1 pt-4 rounded-3xl">
        @include("components.profile._main")
        </main>
        </div>

    </body>
</html>
