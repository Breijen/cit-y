<div class="pb-4 p-2">
    <div class="pb-4 cursor-pointer" onclick="location.href='/profile/{{$follower->username}}'">
        <div class="absolute pt-6 pl-5 rounded-full ">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 bg-followed_by rounded-full p-1 border border-content_bg" viewBox="0 0 20 20" fill="white"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
        </div>
        <div class="flex items-center mb-1">
            <img src="{{$follower->profile_picture ? asset('storage/' . $follower->profile_picture) : asset('https://eu.ui-avatars.com/api/?name=' . urlencode($follower->username) . '&size=250')}}" alt="Profielfoto" class="rounded-full w-10 h-10 mr-3">
            <div>
                <div class="flex">
                    <a href="/profile/{{$follower->username}}" class="font-bold text-md text-white hover:underline">
                    {{$follower->username}} 
                    </a>
                    <p class="text-gray-400 pl-1 pt-[2px] text-placeholder text-sm">
                    @php
                        $now = new DateTime();
                        $ago = new DateTime($follower->created_at);
                        $diff = $now->diff($ago);

                        if ($diff->y > 0) {
                            echo $diff->y . 'y';
                        } elseif ($diff->m > 0) {
                            echo $diff->m . 'm';
                        } elseif ($diff->d > 0) {
                            echo $diff->d . 'd';
                        } elseif ($diff->h > 0) {
                            echo $diff->h . 'h';
                        } elseif ($diff->i > 0) {
                            echo $diff->i . 'm';
                        } else {
                            echo $diff->s . 's';
                        }
                    @endphp
                    </p>
                </div>
                <div class="text-placeholder text-md -mt-1 sm:text-md">
                started following you
                </div>
            </div>
        </div>
    </div>
    <hr class="border-divider">
</div>
