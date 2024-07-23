<div class="p-3 cursor-pointer">
    <div class="flex items-center mb-4" >
        <img src="{{$post->user->profile_picture ? asset('storage/' . $post->user->profile_picture) : asset('https://eu.ui-avatars.com/api/?name=John+Doe&size=250')}}" alt="Profielfoto" class="rounded-full w-10 h-10 mr-3">
        <div>
            <a href="/profile/{{$post['username']}}" class="font-bold text-lg text-white hover:underline">{{$post['username']}}</a>
            <div class="text-gray-400 text-sm">
            @php
                $now = new DateTime();
                $ago = new DateTime($post->created_at);
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
            @endphp</div>
        </div>
        @auth
        @if(Auth::user()->id === $post->user_id)
        <div class="inline-flex ml-auto" data-twe-dropdown-ref >
            <button
            class="hover:bg-background rounded-md p-1"
            type="button"
            onclick="passContent('{{$post['content']}}', '{{$post['id']}}')"
            id="postSettingsDropdown"
            data-twe-dropdown-toggle-ref
            aria-expanded="false"
            data-twe-ripple-init
            data-twe-ripple-color="light">
                <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21.1938 2.80624C22.2687 3.88124 22.2687 5.62415 21.1938 6.69914L20.6982 7.19469C20.5539 7.16345 20.3722 7.11589 20.1651 7.04404C19.6108 6.85172 18.8823 6.48827 18.197 5.803C17.5117 5.11774 17.1483 4.38923 16.956 3.8349C16.8841 3.62781 16.8366 3.44609 16.8053 3.30179L17.3009 2.80624C18.3759 1.73125 20.1188 1.73125 21.1938 2.80624Z" fill="#3A3E41"/>
                <path d="M14.5801 13.3128C14.1761 13.7168 13.9741 13.9188 13.7513 14.0926C13.4886 14.2975 13.2043 14.4732 12.9035 14.6166C12.6485 14.7381 12.3775 14.8284 11.8354 15.0091L8.97709 15.9619C8.71035 16.0508 8.41626 15.9814 8.21744 15.7826C8.01862 15.5837 7.9492 15.2897 8.03811 15.0229L8.99089 12.1646C9.17157 11.6225 9.26191 11.3515 9.38344 11.0965C9.52679 10.7957 9.70249 10.5114 9.90743 10.2487C10.0812 10.0259 10.2832 9.82394 10.6872 9.41993L15.6033 4.50385C15.867 5.19804 16.3293 6.05663 17.1363 6.86366C17.9434 7.67069 18.802 8.13296 19.4962 8.39674L14.5801 13.3128Z" fill="#3A3E41"/>
                <path d="M20.5355 20.5355C22 19.0711 22 16.714 22 12C22 10.4517 22 9.15774 21.9481 8.0661L15.586 14.4283C15.2347 14.7797 14.9708 15.0437 14.6738 15.2753C14.3252 15.5473 13.948 15.7804 13.5488 15.9706C13.2088 16.1327 12.8546 16.2506 12.3833 16.4076L9.45143 17.3849C8.64568 17.6535 7.75734 17.4438 7.15678 16.8432C6.55621 16.2427 6.34651 15.3543 6.61509 14.5486L7.59235 11.6167C7.74936 11.1454 7.86732 10.7912 8.02935 10.4512C8.21958 10.052 8.45272 9.6748 8.72466 9.32615C8.9563 9.02918 9.22032 8.76528 9.57173 8.41404L15.9339 2.05188C14.8423 2 13.5483 2 12 2C7.28595 2 4.92893 2 3.46447 3.46447C2 4.92893 2 7.28595 2 12C2 16.714 2 19.0711 3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355Z" fill="#3A3E41"/>
                </svg>
            </button>
            @include("components.posts._settings_post")

        </div>
        @endif
        @endauth        
    </div>
    <div>
    <p class="text-gray-300">{{$post['content']}}</p>
    @if($post->image_one != null)
    <img class="h-60 mt-4 border-2 border-divider" src="{{ asset('storage/' . $post->image_one) }}" >
    @endif
    </div>
    @auth
    <div class="flex z-20 items-center mt-4 text-gray-300 space-x-6">
        <!-- Likes Icon and Count -->
        <div class="flex items-center space-x-2">
            <form action="{{ route('likePost', ['post' => $post->id]) }}" method="POST" id="likeForm-{{ $post->id }}">
                @csrf
                <button class="mt-4" type="submit" id="likeButton-{{ $post->id }}">
                    <svg width="26px" height="26px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 6.00019C10.2006 3.90317 7.19377 3.2551 4.93923 5.17534C2.68468 7.09558 2.36727 10.3061 4.13778 12.5772C5.60984 14.4654 10.0648 18.4479 11.5249 19.7369C11.6882 19.8811 11.7699 19.9532 11.8652 19.9815C11.9483 20.0062 12.0393 20.0062 12.1225 19.9815C12.2178 19.9532 12.2994 19.8811 12.4628 19.7369C13.9229 18.4479 18.3778 14.4654 19.8499 12.5772C21.6204 10.3061 21.3417 7.07538 19.0484 5.17534C16.7551 3.2753 13.7994 3.90317 12 6.00019Z" stroke="#E2CFEA" fill="{{ $post->isLikedByUser ? '#E2CFEA' : 'none' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </form>
            <p class="text-md mt-3px">{{ $post->likedBy()->count() }}</p>
        </div>

        <!-- Comments Icon and Count -->
        <div class="flex items-center space-x-2">
            <button data-twe-toggle="modal"
                onclick="passPost('{{$post['id']}}')"
                data-twe-target="#createCommentModal"
                data-twe-ripple-init
                data-twe-ripple-color="light"
                data-twe-dropdown-item-ref>
                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 13.5997 2.37562 15.1116 3.04346 16.4525C3.22094 16.8088 3.28001 17.2161 3.17712 17.6006L2.58151 19.8267C2.32295 20.793 3.20701 21.677 4.17335 21.4185L6.39939 20.8229C6.78393 20.72 7.19121 20.7791 7.54753 20.9565C8.88837 21.6244 10.4003 22 12 22Z" stroke="#E2CFEA" stroke-width="1.5"/>
                </svg>
            </button>
            <p class="text-md mt-3px">{{ $post->comments()->count() }}</p>
        </div>

        <!-- Reposts Icon and Count -->
        <div class="flex items-center space-x-2">
            <svg width="24px" height="24px" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                <path d="M12.9998 8L6 14L12.9998 21" stroke="#E2CFEA" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M6 14H28.9938C35.8768 14 41.7221 19.6204 41.9904 26.5C42.2739 33.7696 36.2671 40 28.9938 40H11.9984" stroke="#E2CFEA" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <p class="text-md mt-3px">{{$post['reposts']}}</p>
        </div>

        <!-- Shares Icon and Count -->
        <div class="flex items-center space-x-2">
            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                <path d="M13.47 4.13998C12.74 4.35998 12.28 5.96 12.09 7.91C6.77997 7.91 2 13.4802 2 20.0802C4.19 14.0802 8.99995 12.45 12.14 12.45C12.34 14.21 12.79 15.6202 13.47 15.8202C15.57 16.4302 22 12.4401 22 9.98006C22 7.52006 15.57 3.52998 13.47 4.13998Z" stroke="#E2CFEA" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <p class="text-md mt-3px">{{$post['shares']}}</p>
        </div>
    </div>
    @include("components.posts._create_comment_modal")
    @endauth
</div>
<hr class="border-divider">

@script
<script>
    async function passContent(content, id) {
        document.getElementById('postEditForm').action = "/posts/" + id;
        document.getElementById('postDeleteForm').action = "/posts/" + id;
        document.getElementById('postEditInput').value = content;
    }

    async function passPost(id) {
        document.getElementById('createCommentForm').action = "/posts/" + id + "/comments";
    }
</script>
@endscript
