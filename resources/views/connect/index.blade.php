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
            <div class="fixed flex justify-center items-center h-20 bottom-0 w-full bg-background text-white z-50">
                <button id="button-selector" class="bg-content_bg p-2 border border-divider">
                    SELECTOR
                </button>
                <button id="button-placer" class="bg-content_bg p-2 border border-divider">
                    PLACER
                </button>
            </div>
        </main>
    </div>

    @vite('resources/js/connect/main.js')
</body>
</html>

