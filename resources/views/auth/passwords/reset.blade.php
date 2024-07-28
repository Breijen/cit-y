@vite('resources/css/app.css')
@vite('resources/js/app.js')

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @php
            $pageName = 'Reset Password';
        @endphp

        <title>Cit-Y</title>

        @vite('resources/css/app.css')

    </head>
    <body class="bg-background">
        @include("components._header")

        <main class="flex-1 pt-24 flex justify-center items-center bg-background">
            <div class="max-w-2xl bg-content_bg rounded-lg border border-divider px-8 py-10 flex flex-col items-center">
                <h1 class="text-xl font-bold text-center text-white mb-8">Reset Password</h1>
                <form method="POST" action="{{ route('password.update') }}" class="w-full flex flex-col gap-4">
                @csrf    
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="flex items-start flex-col justify-start w-full">
                        <input type="email" id="email" name="email" placeholder="Email" class="text-white w-full px-3 py-2 rounded-md border border-divider focus:outline-none bg-background placeholder-placeholder" value="{{ old('email') }}" required autofocus>
                    @error    ('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror    
                    </div>
                    <div class="flex items-start flex-col justify-start w-full">
                        <input type="password" id="password" name="password" placeholder="Password" class="text-white w-full px-3 py-2 rounded-md border border-divider focus:outline-none bg-background placeholder-placeholder" required>
                    @error    ('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    </div>
                    <div class="flex items-start flex-col justify-start w-full">
                        <input type="password" id="password-confirm" name="password_confirmation" placeholder="Confirm Password" class="text-white w-full px-3 py-2 rounded-md border border-divider focus:outline-none bg-background placeholder-placeholder" required>
                    </div>
                    <button type="submit" class="border border-divider hover:bg-icons text-white font-medium py-2 px-4 rounded-md shadow-sm">Reset Password</button>
                </form>
            </div>
        </main>
    </body>
</html>
