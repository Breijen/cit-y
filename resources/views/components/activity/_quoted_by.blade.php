<div class="pb-4 p-2">
    <div class="absolute pt-6 pl-6">
        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 bg-quoted_by rounded-full p-1 border border-content_bg">
            <path d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C16.3556 22 20.0584 19.2159 21.4307 15.3332C21.6148 14.8125 21.3418 14.2412 20.8211 14.0572C20.3004 13.8731 19.7291 14.146 19.545 14.6668C18.4463 17.7753 15.4817 20 12 20C7.58172 20 4 16.4183 4 12C4 7.58172 7.58172 4 12 4C13.5516 4 14.8662 4.56117 16.1162 5.4406C16.9569 6.03212 17.7348 6.74106 18.5242 7.5H15.5C14.9477 7.5 14.5 7.94772 14.5 8.5C14.5 9.05228 14.9477 9.5 15.5 9.5H21C21.5523 9.5 22 9.05228 22 8.5V3C22 2.44772 21.5523 2 21 2C20.4477 2 20 2.44772 20 3V6.14371C19.1517 5.32583 18.2456 4.49337 17.267 3.80489C15.7949 2.76916 14.0847 2 12 2Z" fill="white"/>
        </svg>
    </div>
    <div class="flex pb-4 cursor-pointer" onclick="location.href='/{{$quote['username']}}/{{$quote['uuid']}}'">
        <img src="{{$quote->postUser->profile_picture ? asset('storage/' . $quote->postUser->profile_picture) : asset('https://eu.ui-avatars.com/api/?name=John+Doe&size=250')}}" alt="Profielfoto" class="rounded-full w-10 h-10 mr-3">
        <div class="flex items-center mb-1" >
            <div class="pl-1">
                <div class="flex">
                    <a href="/profile/{{$quote->postUser->username}}" class="font-bold text-md text-white hover:underline">
                    {{$quote->postUser->username}} 
                    </a>
                    <p class="text-gray-400 pl-1 pt-[2px] text-placeholder text-sm">
                    @php
                        $now = new DateTime();
                        $ago = new DateTime($quote->created_at);
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
                {{$quote->post["content"]}}
                </div>
                <div>
                    <p class="text-gray-300 text-sm mt-1">{{$post['content']}}</p>
                </div>
            </div>
        </div>
    </div>
    <hr class="border-divider">
</div>
