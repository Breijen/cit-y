<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @php
        $pageName = 'Explore';
    @endphp

    <title>Cit-Y</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-background">

    <div class="flex">
        @include("components._sidebar")
        @include("components.alerts._shared")

        @auth
            @include("components._create_post")
            @include("components.posts._create_post_modal")
        @endauth   

        <main>

        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/OrbitControls.js"></script>
    @vite('resources/js/connect/main.js')
</body>
</html>
