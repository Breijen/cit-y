<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password - Cit-Y</title>
        @php
            $pageName = 'Forgot Password';
        @endphp
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-background">
    @include("components._header")

    <main class="flex-1 pt-24 flex justify-center items-center bg-background">
        <div class="max-w-lg mx-auto bg-content_bg rounded-lg border border-divider px-8 py-10 flex flex-col items-center">
            <h1 class="text-xl font-bold text-center text-white mb-8">Forgot Your Password?</h1>
            <p class="text-center text-white mb-6">No worries! Just let us know your email address and we will email you a password reset link.</p>
            @if (session('status'))
                <div class="bg-green-600 text-white p-4 rounded-lg shadow-md w-full mb-4">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}" class="w-full flex flex-col gap-4">
                @csrf
                <div class="flex items-start flex-col justify-start w-full">
                    <input type="email" id="email" name="email" placeholder="Email" class="text-white w-full px-3 py-2 mt-4 rounded-md border border-divider focus:outline-none bg-background placeholder-placeholder" value="{{ old('email') }}" required>
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="border border-divider hover:bg-icons text-white font-medium py-2 px-4 rounded-md shadow-sm">Send Password Reset Link</button>
            </form>
        </div>
    </main>
</body>
</html>
