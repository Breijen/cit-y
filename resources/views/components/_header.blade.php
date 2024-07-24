<header class="top-0 z-50 h-24 w-full flex items-center sticky justify-between sm:px-10 px-3 bg-background">
    <!-- Naam van de website links -->
    <a href="/" class="pl-2 text-white text-3xl md:text-4xl font-bold">
        Cit-Y
    </a>

    <div class="absolute left-1/2 transform -translate-x-1/2 text-white md:inline hidden md:text-xl font-bold">
        {{ $pageName }}
    </div>

    
    <!-- Profiel aan de rechterkant -->
    <div class="flex items-center space-x-4 text-white">
        @auth
        <div class="flex flex-col items-end">
            <div class="text-md font-medium">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</div>
            <div class="text-sm font-regular lowercase">{{ auth()->user()->username }}</div>
        </div>
        <a href="/profile/{{ auth()->user()->username }}">
            <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('https://eu.ui-avatars.com/api/?name=John+Doe&size=250') }}" class="h-10 w-10 rounded-full cursor-pointer border-2 border-divider" />
        </a>
        @else
        <a href="/login" class="text-center h-10 w-24 bg-white text-black text-lg rounded-xl p-2 font-semibold">
            <p>Log in</p>
        </a>
        @endauth
    </div>
</header>
