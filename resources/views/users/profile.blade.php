@vite('resources/css/app.css')
@vite('resources/js/app.js')

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cit-Y</title>

        @vite('resources/css/app.css')

    </head>
    <body class="bg-background">
        @include("components._header")

        <div class="flex">
        @include("components._sidebar")

        <main class="flex-1 pt-4">
        @include("components.profile._main")
        </main>
        </div>

    </body>
</html>