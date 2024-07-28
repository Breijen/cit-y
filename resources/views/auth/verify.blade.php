@vite('resources/css/app.css')
@vite('resources/js/app.js')

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @php
            $pageName = 'Verify';
        @endphp

        <title>Cit-Y</title>

        @vite('resources/css/app.css')

    </head>
    <body class="bg-background">
        @include("components._header")

        <main class="flex-1 pt-24 flex justify-center items-center bg-background">
            <div class="max-w-lg mx-auto bg-content_bg rounded-lg border border-divider px-8 py-10 flex flex-col items-center">
                <h1 class="text-xl font-bold text-center text-white mb-8">Verify Your Email Address</h1>
                @if(session('resent'))
                    <div class="bg-green-600 text-white p-4 rounded-lg shadow-md w-full mb-4">
                        'A fresh verification link has been sent to your email address.
                    </div>
                @endif    
                <p class="text-center text-white mb-6">Before proceeding, please check your email for a verification link.</p>
                <p class="text-center text-white mb-6">Didn't receive an email?</p>
                <form class="inline-block" method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="border border-divider hover:bg-icons text-white font-medium py-2 px-4 rounded-md shadow-sm">
                        {{ __('Click here to request another') }}
                    </button>
                </form>
            </div>
        </main>
    </body>
</html>


