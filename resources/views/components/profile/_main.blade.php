<div class="max-w-4xl mx-auto h-auto bg-content_bg rounded-3xl mb-32 border border-divider relative">
    <!-- Banner Image -->
    <div class="w-full overflow-hidden rounded-t-3xl bg-background" style="height: 150px;">
        <img src="{{ $user->banner ? asset('storage/' . $user->banner) : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=' }}" class="w-full object-cover" style="height: 150px;">
    </div>
    
    <!-- Profile Picture and Info -->
    <div class="flex items-center absolute top-0 left-0 w-full mt-32">
        <div class="relative mt-2 sm:mt-6 sm:ml-6">
            <img class="w-16 h-16 sm:w-32 sm:h-32 rounded-full border-2 border-divider object-cover bg-background" src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('https://eu.ui-avatars.com/api/?name=John+Doe&size=250') }}" style="position: relative; top: -64px; left: 18px;">
        </div>
    </div>
    
    <!-- Edit Profile Button -->
    @auth
    @if(auth()->user()->username === $user->username)
    <div class="absolute top-0 right-0 m-4 space-x-1">
        <button class="hidden sm:inline p-2 border border-icons bg-divider text-sm text-white font-medium rounded-md"
            onclick="passProfileContent('{{ $user->firstname }}', '{{ $user->lastname }}', '{{ $user->bio }}', '{{ $user->website }}')"
            data-twe-toggle="modal"
            data-twe-target="#editProfileModal"
            data-twe-ripple-init
            data-twe-ripple-color="light"
            data-twe-dropdown-item-ref>Edit Profile</button>
        <form class="inline" method="POST" action="/logout">
            @csrf
            <button type="submit" class="relative text-center h-9 w-16 bg-white text-black text-sm rounded-md font-semibold">Logout</button>
        </form>
    </div>

    @endif
    @endauth        

    <div class="flex absolute mt-2 w-full">
        <div class="w-full mt-1 sm:ml-48 sm:mt-0 px-4 sm:px-0">
            <h1 class="text-sm sm:text-2xl font-bold text-white">{{ $user->firstname }} {{ $user->hide_last_name ? '' : $user->lastname }}</h1>
            <p class="text-xs sm:text-sm text-gray-400">{{ $user->username }}</p>
            <p class="mt-2 text-gray-400 text-xs">{{ $user->bio }}</p>
        @auth      
     @if(auth()->user()->id !== $user->id)
            @if(auth()->user()->following->contains($user))
                <div class="mt-4">
                    <form action="{{ route('unfollow', $user->id) }}" method="POST" class="inline">
                    @csrf                  
                        <button type="submit" class="bg-content_bg p-1 border border-icons text-placeholder rounded-lg w-24 text-sm">Following</button>
                    </form>
                </div>
            @else            
                <div class="mt-4">
                    <form action="{{ route('follow', $user->id) }}" method="POST" class="inline">
                    @csrf            
                        <button type="submit" class="bg-white border p-1 rounded-lg w-24 text-sm">Follow</button>
                    </form>
                </div>
            @endif
            @endif
        @endauth
        </div>

        <!-- Followers and Website -->
        <div class="w-full mt-2 sm:mt-0 sm:flex sm:justify-end px-4">
            <div class="flex space-x-2 text-gray-400 justify-end text-xxs sm:text-sm">
                <p>{{ $user->followerCount }} followers</p>
                <p>-</p>
                <p>{{ $user->website }}</p>
            </div>
        </div>
    </div>

    <div class="relative"> <!-- Add relative positioning to the parent div -->
    @auth    
        @if(auth()->user()->id != $user->id)
            <div class="absolute bottom-0 right-0 mb-4 mr-4" data-twe-dropdown-ref> <!-- Position the button to the bottom-right -->
                <button
                class="hover:bg-background rounded-md p-1"
                type="button"
                id="profileSettingsDropdown"
                data-twe-dropdown-toggle-ref
                aria-expanded="false"
                data-twe-ripple-init
                data-twe-ripple-color="light">
                    <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M7.75745 10.5858L9.17166 9.17154L12.0001 12L14.8285 9.17157L16.2427 10.5858L12.0001 14.8284L7.75745 10.5858Z"
                        fill="#3A3E41"
                      />
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M1 12C1 5.92487 5.92487 1 12 1C18.0751 1 23 5.92487 23 12C23 18.0751 18.0751 23 12 23C5.92487 23 1 18.0751 1 12ZM12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21Z"
                        fill="#3A3E41"
                      />
                    </svg>
                </button>
            @include("components.profile._settings")
            </div>
        @endif    
    @endauth  
    </div>

    <!-- Tabs -->
    <div class="bg-content_bg w-full rounded-3xl mt-40">
        <div class="flex justify-around p-4 border-b border-divider">
            <button class="text-red-500 border-b-2 border-red-500" onclick="showTab('posts')">Posts</button>
            <button class="text-placeholder" onclick="showTab('replies')">Replies</button>
            <button class="text-placeholder" onclick="showTab('media')">Media</button>
            <button class="text-placeholder" onclick="showTab('likes')">Likes</button>
        </div>

        @if($user->pinned_post_id != null)
            <div id="pinned" class=" p-4">
                @include("components.profile._pinned")
            </div>
        @endif

        <!-- Tab Contents -->
        <div id="posts" class="tab-content p-4">
            @include("components.profile._posts")
        </div>

        <div id="replies" class="tab-content hidden p-4">
            @include("components.profile._comments")
        </div>

        <div id="media" class="flex tab-content hidden justify-center items-center">
            <p class="text-placeholder p-4">Functionaliteit werkt nog niet.</p>
        </div>

        <div id="likes" class="tab-content hidden p-4">
            @include("components.profile._liked")
        </div>
    </div>

    @auth
    @include("components.profile._update_profile_modal")
    @endauth
</div>

<script type="text/javascript">

    function passProfileContent(userFirstname, userLastname, userBio, userWebsite) {
        document.getElementById('firstname').value = userFirstname;
        document.getElementById('lastname').value = userLastname;
        document.getElementById('bio').value = userBio;
        document.getElementById('website').value = userWebsite;
    }

    function showTab(tabId) {
        // Hide all tab content
        const tabContents = document.querySelectorAll('.tab-content');
        tabContents.forEach(content => content.classList.add('hidden'));

        // Remove active classes from all buttons
        const tabButtons = document.querySelectorAll('.flex button');
        tabButtons.forEach(button => {
            button.classList.remove('text-red-500', 'border-b-2', 'border-red-500');
            button.classList.add('text-placeholder', );
        });

        // Show the selected tab content
        document.getElementById(tabId).classList.remove('hidden');

        // Add active class to the clicked button
        event.target.classList.add('text-red-500', 'border-b-2', 'border-red-500');
        event.target.classList.remove('text-placeholder',);
    }
</script>
