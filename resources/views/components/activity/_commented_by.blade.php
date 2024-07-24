<div class="pb-4 p-2">
    <div class="pb-4 cursor-pointer" onclick="location.href='/{{$post['username']}}/{{$post['uuid']}}'">
        <div class="flex items-center mb-1" >
            <img src="{{$comment->user->profile_picture ? asset('storage/' . $comment->user->profile_picture) : asset('https://eu.ui-avatars.com/api/?name=John+Doe&size=250')}}" alt="Profielfoto" class="rounded-full w-10 h-10 mr-3">
            <div>
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
                <div class="text-placeholder text-md sm:text-xl">
                {{$post["content"]}}
                </div>
                <div>
                    <p class="pt-1 text-gray-300 text-md sm:text-xl">{{$comment['content']}}</p>
                </div>
            </div>
        </div>
    </div>
    <hr class="border-divider">
</div>
