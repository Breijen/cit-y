<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

        @include("connect._payment_form")

        <main>

        </main>
    </div>

    @vite('resources/js/connect/main.js')
</body>
</html>
