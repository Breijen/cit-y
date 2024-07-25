<div class="mt-4 p-2">
    <div class="mb-4 cursor-pointer flex items-center justify-between" onclick="location.href='/profile/{{$user['username']}}'">
        <div class="flex">
            <img src="{{$user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('https://eu.ui-avatars.com/api/?name=John+Doe&size=250')}}" alt="Profielfoto" class="rounded-full w-10 h-10 mr-3">
            <div>
                <a href="/profile/{{$user['username']}}" class="font-bold text-lg text-white hover:underline lowercase">{{$user['username']}}</a>
                <p class="text-placeholder">{{$user['firstname']}} {{$user['lastname']}}</p>
                <p class="text-white">{{ $user->followerCount }} followers</p>
            </div>        
        </div>
        @auth      
            @if(auth()->user()->id !== $user->id)
                @if(auth()->user()->following->contains($user))
                <div class="mt-1">
                    <form action="{{ route('unfollow', $user->id) }}" method="POST" class="inline">
                    @csrf                  
                        <button type="submit" class="bg-content_bg p-1 border border-icons text-placeholder rounded-lg w-24 text-sm">Following</button>
                    </form>
                </div>
                @else            
                <div class="mt-1">
                    <form action="{{ route('follow', $user->id) }}" method="POST" class="inline">
                    @csrf            
                        <button type="submit" class="bg-white border p-1 rounded-lg w-24 text-sm">Follow</button>
                    </form>
                </div>
                @endif
            @endif
        @endauth
    </div>
</div>
