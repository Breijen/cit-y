<div class="pb-4 p-2 w-full">
    <div class="p-3 cursor-pointer" onclick="location.href='/{{$comment->post['username']}}/{{$comment->post['uuid']}}';">
        <div class="flex items-center mb-4">
            <img src="{{$comment->user->profile_picture ? asset('storage/' . $comment->user->profile_picture) : asset('https://eu.ui-avatars.com/api/?name=John+Doe&size=250')}}" alt="Profielfoto" class="rounded-full w-10 h-10 mr-3">
            <div>
                <div class="flex">
                    <a href="/profile/{{$comment->user->username}}" class="font-bold text-lg text-white hover:underline">
                    {{$comment->user->username}} 
                    </a>
                    <p class="text-gray-400 pl-2 pt-[2px] text-placeholder text-sm">
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
                <div class="text-placeholder text-sm">
                Replied to {{$comment->post->user->username}}
                </div>
            </div>
        @auth    
        @if(auth()->user()->id === $comment->user_id)
            <div class="inline-flex ml-auto" data-twe-dropdown-ref >
                <button
                class="hover:bg-background rounded-md p-1"
                type="button"
                onclick="passCommentContent('{{ $comment['content'] }}', '{{ $comment['id'] }}', '{{ $comment->post->id }}')"
                id="editSettingsDropdown"
                data-twe-dropdown-toggle-ref
                aria-expanded="false"
                data-twe-ripple-init
                data-twe-ripple-color="light">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21.1938 2.80624C22.2687 3.88124 22.2687 5.62415 21.1938 6.69914L20.6982 7.19469C20.5539 7.16345 20.3722 7.11589 20.1651 7.04404C19.6108 6.85172 18.8823 6.48827 18.197 5.803C17.5117 5.11774 17.1483 4.38923 16.956 3.8349C16.8841 3.62781 16.8366 3.44609 16.8053 3.30179L17.3009 2.80624C18.3759 1.73125 20.1188 1.73125 21.1938 2.80624Z" fill="#3A3E41"/>
                    <path d="M14.5801 13.3128C14.1761 13.7168 13.9741 13.9188 13.7513 14.0926C13.4886 14.2975 13.2043 14.4732 12.9035 14.6166C12.6485 14.7381 12.3775 14.8284 11.8354 15.0091L8.97709 15.9619C8.71035 16.0508 8.41626 15.9814 8.21744 15.7826C8.01862 15.5837 7.9492 15.2897 8.03811 15.0229L8.99089 12.1646C9.17157 11.6225 9.26191 11.3515 9.38344 11.0965C9.52679 10.7957 9.70249 10.5114 9.90743 10.2487C10.0812 10.0259 10.2832 9.82394 10.6872 9.41993L15.6033 4.50385C15.867 5.19804 16.3293 6.05663 17.1363 6.86366C17.9434 7.67069 18.802 8.13296 19.4962 8.39674L14.5801 13.3128Z" fill="#3A3E41"/>
                    <path d="M20.5355 20.5355C22 19.0711 22 16.714 22 12C22 10.4517 22 9.15774 21.9481 8.0661L15.586 14.4283C15.2347 14.7797 14.9708 15.0437 14.6738 15.2753C14.3252 15.5473 13.948 15.7804 13.5488 15.9706C13.2088 16.1327 12.8546 16.2506 12.3833 16.4076L9.45143 17.3849C8.64568 17.6535 7.75734 17.4438 7.15678 16.8432C6.55621 16.2427 6.34651 15.3543 6.61509 14.5486L7.59235 11.6167C7.74936 11.1454 7.86732 10.7912 8.02935 10.4512C8.21958 10.052 8.45272 9.6748 8.72466 9.32615C8.9563 9.02918 9.22032 8.76528 9.57173 8.41404L15.9339 2.05188C14.8423 2 13.5483 2 12 2C7.28595 2 4.92893 2 3.46447 3.46447C2 4.92893 2 7.28595 2 12C2 16.714 2 19.0711 3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355Z" fill="#3A3E41"/>
                    </svg>
                </button>
            @include    ("components.comments._settings_comment")

            </div>
        @endif    
        @endauth            
        </div>
        <div>
        <p class="text-gray-300">{{$comment['content']}}</p>
    @if    ($comment->comment_image_one != null)
        <img class="h-60 mt-4 border-2 border-divider" src="{{ asset('storage/' . $comment->comment_image_one) }}" >
    @endif    
        </div>
    @auth    
        <div class="flex items-center mt-4 text-gray-300 space-x-6">
            <!-- Likes Icon and Count -->
            <div class="flex items-center space-x-2">
                <form action="{{ route('likeComment', ['comment' => $comment->id]) }}" method="POST" id="likeForm-{{ $comment->id }}">
                @csrf    
                    <button class="mt-4" type="submit" id="likeButton-{{ $comment->id }}">
                        <svg width="26px" height="26px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 6.00019C10.2006 3.90317 7.19377 3.2551 4.93923 5.17534C2.68468 7.09558 2.36727 10.3061 4.13778 12.5772C5.60984 14.4654 10.0648 18.4479 11.5249 19.7369C11.6882 19.8811 11.7699 19.9532 11.8652 19.9815C11.9483 20.0062 12.0393 20.0062 12.1225 19.9815C12.2178 19.9532 12.2994 19.8811 12.4628 19.7369C13.9229 18.4479 18.3778 14.4654 19.8499 12.5772C21.6204 10.3061 21.3417 7.07538 19.0484 5.17534C16.7551 3.2753 13.7994 3.90317 12 6.00019Z" stroke="#E2CFEA" fill="{{ $comment->likedBy->contains(auth()->id()) ? '#E2CFEA' : 'null' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </form>
                <p class="text-md mt-3px">{{ $comment->likedBy()->count() }}</p>
            </div>
        </div>
    @endauth  
    </div>
    <hr class="border-divider">
</div>
