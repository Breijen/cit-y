<div class="max-w-lg mx-auto bg-content_bg rounded-lg border border-divider px-8 py-10 flex flex-col items-center">
    <h1 class="text-xl font-bold text-center text-white mb-8">Create a Cit-Y account</h1>
    <form method="POST" action="/users" class="w-full flex flex-col gap-4">
        @csrf
        <div class="flex items-start flex-col justify-start">
            <input type="text" id="firstname" name="firstname" placeholder="First name" class="text-white placeholder-placeholder w-full px-3 py-2 rounded-md border border-divider focus:outline-none bg-background" value={{old('firstName')}}>
            @error('name')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="flex items-start flex-col justify-start">
            <input type="text" id="lastname" name="lastname" placeholder="Last name" class="placeholder-placeholder text-white w-full px-3 py-2 rounded-md border border-divider focus:outline-none bg-background" value={{old('lastName')}}>
            @error('name')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="flex items-start flex-col justify-start">
            <input type="email" id="email" name="email" placeholder="Email" class="placeholder-placeholder text-white w-full px-3 py-2 rounded-md border border-divider focus:outline-none bg-background" value={{old('email')}}>
            @error('email')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <hr class="border-divider" />

        <div class="flex items-start flex-col justify-start">
            <input type="text" id="username" name="username" placeholder="Username" class="placeholder-placeholder text-white w-full px-3 py-2 rounded-md border border-divider focus:outline-none bg-background" value={{old('username')}}>
            @error('username')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="flex items-start flex-col justify-start">
            <input type="password" id="password" name="password" placeholder="Password" class="placeholder-placeholder text-white w-full px-3 py-2 rounded-md border border-divider focus:outline-none bg-background">
            @error('password')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="flex items-start flex-col justify-start">
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" class="placeholder-placeholder text-white w-full px-3 py-2 rounded-md border border-divider focus:outline-none bg-background">
        </div>

        <button type="submit" class="border border-divider hover:bg-icons text-white font-medium py-2 px-4 rounded-md shadow-sm">Register</button>
    </form>

    <div class="mt-4 text-center">
        <span class="text-sm text-gray-500 dark:text-gray-300">Already have an account? </span>
        <a href="/login" class="text-blue-500 hover:text-blue-600">Login</a>
    </div>
</div>
