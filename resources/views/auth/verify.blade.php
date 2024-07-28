@vite('resources/css/app.css')
@vite('resources/js/app.js')

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @php
            $pageName = 'Log in';
        @endphp

        <title>Cit-Y</title>

        @vite('resources/css/app.css')

    </head>
    <body class="bg-background">
        @include("components._header")

        <main class="flex-1 pt-24 flex justify-center items-center bg-background">
            <div class="w-full max-w-4xl mx-auto p-6 bg-content_bg rounded-3xl shadow-lg border border-divider text-white">
                <div class="flex justify-center">
                    <div class="w-full">
                        <div class="space-y-6">
                            <div class="text-center">
                                <h1 class="text-3xl font-bold">{{ __('Verify Your Email Address') }}</h1>
                            </div>
                    @if         (session('resent'))
                                <div class="bg-green-600 text-white p-4 rounded-lg shadow-md">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                    @endif        
                            <div class="text-center space-y-4">
                                <p class="text-lg">{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                                <p class="text-lg">{{ __('If you did not receive the email') }},</p>
                                <form class="inline-block" method="POST" action="{{ route('verification.send') }}">
                            @csrf
                                    <button type="submit" class="btn btn-link text-blue-500 hover:underline">
                                        {{ __('click here to request another') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </body>
</html>


