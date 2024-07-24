<div class="pb-4 p-2">
    <div class="absolute pt-6 pl-6">
        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 bg-commented_by rounded-full p-1 border border-content_bg">
            <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 13.5997 2.37562 15.1116 3.04346 16.4525C3.22094 16.8088 3.28001 17.2161 3.17712 17.6006L2.58151 19.8267C2.32295 20.793 3.20701 21.677 4.17335 21.4185L6.39939 20.8229C6.78393 20.72 7.19121 20.7791 7.54753 20.9565C8.88837 21.6244 10.4003 22 12 22Z" fill="white" stroke-width="1.5"/>
        </svg>
    </div>
    <div class="flex pb-4 cursor-pointer" onclick="location.href='/{{$post['username']}}/{{$post['uuid']}}'">
        <img src="{{$comment->user->profile_picture ? asset('storage/' . $comment->user->profile_picture) : asset('https://eu.ui-avatars.com/api/?name=John+Doe&size=250')}}" alt="Profielfoto" class="rounded-full w-10 h-10 mr-3">
        <div class="flex items-center mb-1" >
            <div class="pl-1">
                <div class="flex">
                    <a href="/profile/{{$comment->user->username}}" class="font-bold text-md text-white hover:underline">
                    {{$comment->user->username}} 
                    </a>
                    <p class="text-gray-400 pl-1 pt-[2px] text-placeholder text-sm">
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
                <div class="text-placeholder text-sm max-w-60 truncate">
                {{$post["content"]}}
                </div>
                <div>
                    <p class="text-gray-300 text-sm mt-1">{{$comment['content']}}</p>
                </div>
            </div>
        </div>
    </div>
    <hr class="border-divider">
</div>
