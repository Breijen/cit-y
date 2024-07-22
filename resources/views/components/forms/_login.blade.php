<div class="max-w-lg mx-auto bg-content_bg rounded-lg border border-divider px-8 py-10 flex flex-col items-center">
    <h1 class="text-xl font-bold text-center text-white mb-8">Log in with your Cit-Y account</h1>
    <form method="POST" action="/users/authenticate" class="w-full flex flex-col gap-4">
        @csrf

        <div class="flex items-start flex-col justify-start">
            <input type="text" id="username" name="username" placeholder="Username" class="text-white w-full px-3 py-2 rounded-md border border-divider focus:outline-none bg-background placeholder-placeholder" value={{old('username')}}>
            @error('email')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="flex items-start flex-col justify-start">
            <input type="password" id="password" name="password" placeholder="Password" class="text-white w-full px-3 py-2 rounded-md border border-divider focus:outline-none bg-background placeholder-placeholder">
            @error('password')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
            <a href="/register" class="mt-2 ml-1 text-xs text-placeholder hover:text-blue-600">Forgot password?</a>
        </div>


        <button type="submit" class="border border-divider hover:bg-icons text-white font-medium py-2 px-4 rounded-md shadow-sm">Log in</button>
    </form>

    <div class="mt-4 text-center">
        <span class="text-sm text-gray-500 dark:text-gray-300">Don't have an account yet? </span>
        <a href="/register" class="text-blue-500 hover:text-blue-600">Register</a>
    </div>
</div>
