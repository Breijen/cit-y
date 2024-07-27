@vite('resources/css/app.css')
@vite('resources/js/app.js')

<!DOCTYPE html>
<html lang="en" class="scrollbar-hide">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @livewireStyles
        @php
            $pageName = 'For you';
        @endphp

        <title>Cit-Y</title>

    </head>
    <body class="bg-background">
        @include("components._header")

        <div class="flex">
        @include("components._sidebar")

            <main class="flex-1"> 
                @yield('content')
            </main>
        </div>

        @auth
            @include("components._create_post")
        @endauth

        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

        @livewireScripts
    </body>
</html>
