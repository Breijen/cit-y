<header class="top-0 h-24 w-full flex items-center sticky justify-end sm:px-10 px-3 bg-background">

    <div class="flex flex-shrink-0 items-center space-x-4 text-white">

        @auth

        <div class="flex flex-col items-end">

                <div class="text-md font-medium ">{{auth()->user()->firstname}} {{auth()->user()->lastname}}</div>


                <div class="text-sm font-regular">{{auth()->user()->username}}</div>
        </div>
        
        <a href="/profile/{{auth()->user()->username}}">
            <img src="{{auth()->user()->profile_picture ? asset('storage/' . auth()->user()['profile_picture']) : asset('https://eu.ui-avatars.com/api/?name=John+Doe&size=250')}}" class="h-10 w-10 rounded-full cursor-pointer border-2 border-divider" />
        </a>

        @else
        <a href="/login" class="text-center h-11 w-24 bg-white text-black text-lg rounded-xl p-2 font-semibold">
            <p>Log in</p>
        </a>
        @endauth
    </div>
</header>
