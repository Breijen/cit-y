<div class="pb-4 p-2">
    <div class="pb-4 cursor-pointer" onclick="location.href='/{{$post['username']}}/{{$post['uuid']}}'">
        <div class="absolute pt-8 pl-6">
            <svg width="26px" height="26px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 6.00019C10.2006 3.90317 7.19377 3.2551 4.93923 5.17534C2.68468 7.09558 2.36727 10.3061 4.13778 12.5772C5.60984 14.4654 10.0648 18.4479 11.5249 19.7369C11.6882 19.8811 11.7699 19.9532 11.8652 19.9815C11.9483 20.0062 12.0393 20.0062 12.1225 19.9815C12.2178 19.9532 12.2994 19.8811 12.4628 19.7369C13.9229 18.4479 18.3778 14.4654 19.8499 12.5772C21.6204 10.3061 21.3417 7.07538 19.0484 5.17534C16.7551 3.2753 13.7994 3.90317 12 6.00019Z" stroke="#212121" fill="#FF3131" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="flex items-center mb-1" >
            <img src="{{$mostRecentLike->profile_picture ? asset('storage/' . $mostRecentLike->profile_picture) : asset('https://eu.ui-avatars.com/api/?name=John+Doe&size=250')}}" alt="Profielfoto" class="rounded-full w-10 h-10 mr-3">
            <div>
                <div class="flex">
                    @if($post->likedBy->count() > 1)
                    <a href="/profile/{{$mostRecentLike->username}}" class="font-bold text-md text-white hover:underline">
                    {{ $mostRecentLike->username }}
                    </a>
                    <p class="font-bold pl-2 text-md text-placeholder hover:underline">and {{ $post->likedBy->count() - 1 }} others</p>
                    @else
                    <a href="/profile/{{$mostRecentLike->username}}" class="font-bold text-md text-white hover:underline">
                    {{ $mostRecentLike->username }}
                    </a>
                    <p class="font-bold pl-2 text-md text-placeholder hover:underline">liked your post</p>
                    @endif
                    <p class="text-placeholder pl-2 pt-[2px] text-placeholder text-sm">
                    @php
                        $now = new DateTime();
                        $ago = new DateTime($comment->created_at);
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
                <div class="text-placeholder text-sm sm:text-xl">
                {{$post["content"]}}
                </div>
            </div>
        </div>
    </div>
    <hr class="border-divider">
</div>
