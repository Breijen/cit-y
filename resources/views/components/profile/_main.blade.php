<div class="max-w-4xl mx-auto bg-content_bg rounded-lg border border-divider relative">
    <!-- Banner Image -->
    <div class="w-full overflow-hidden rounded-t-lg bg-background" style="height: 150px;">
        <img src="{{ $user->banner ? asset('storage/' . $user->banner) : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=' }}" class="w-full object-cover" style="height: 150px;">
    </div>
    
    <!-- Profile Picture and Info -->
    <div class="flex items-center absolute top-0 left-0 w-full mt-32">
        <div class="relative mt-6 ml-6">
            <img class="w-32 h-32 rounded-full border-2 border-divider object-cover bg-background" src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('https://eu.ui-avatars.com/api/?name=John+Doe&size=250') }}" style="position: relative; top: -64px; left: 18px;">
        </div>
    </div>
    
    <!-- Edit Profile Button -->
    @auth
    @if(auth()->user()->username === $user->username)
    <div class="absolute top-0 right-0 m-4 space-x-1">
        <button class="p-2 border border-icons bg-divider text-sm text-white font-medium rounded-md"
            onclick="passProfileContent('{{ $user->bio }}', '{{ $user->website }}')"
            data-twe-toggle="modal"
            data-twe-target="#editProfileModal"
            data-twe-ripple-init
            data-twe-ripple-color="light"
            data-twe-dropdown-item-ref>Edit Profile</button>
        <form class="inline" method="POST" action="/logout">
            @csrf
            <button type="submit" class="relative text-center h-9 w-16 bg-white text-black text-sm rounded-md p-2 font-semibold">Logout</button>
        </form>
    </div>

    @endif
    @endauth    

    <div class="flex absolute w-full">
        <div class="w-full ml-48 mt-2">
            <h1 class="text-2xl font-bold text-white">{{ $user->firstname }} {{ $user->lastname }}</h1>
            <p class="text-gray-400">{{ $user->username }}</p>
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
        <div class="space-x-8 justify-end mr-8 mt-2">
            <div class="w-full flex space-x-2 ml-48 mt-2">
                <p class="text-gray-400 justify-end text-xs">{{ $user->followerCount }} followers</p>
                <p class="text-gray-400 justify-end text-xs">-</p>
                <p class="text-gray-400 justify-end text-xs">{{ $user->website }}</p>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="bg-content_bg w-full rounded-lg mt-32">
        <div class="flex justify-around p-4 border-b border-divider">
            <button class="text-red-500 border-b-2 border-red-500 pb-2" onclick="showTab('posts')">Posts</button>
            <button class="text-placeholder" onclick="showTab('replies')">Replies</button>
            <button class="text-placeholder" onclick="showTab('highlights')">Highlights</button>
            <button class="text-placeholder" onclick="showTab('media')">Media</button>
            <button class="text-placeholder" onclick="showTab('likes')">Likes</button>
        </div>

        <!-- Tab Contents -->
        <div id="posts" class="tab-content p-4">
            @auth
            @if(auth()->user()->username === $user->username)
            @include("components.posts._create_post")
            @endif
            @endauth
            @include("components.profile._posts")
        </div>

        <div id="replies" class="flex tab-content hidden justify-center items-center">
            <p class="text-placeholder p-4">Functionaliteit werkt nog niet.</p>
        </div>

        <div id="highlights" class="flex tab-content hidden justify-center items-center">
            <p class="text-placeholder p-4">Functionaliteit werkt nog niet.</p>
        </div>

        <div id="media" class="flex tab-content hidden justify-center items-center">
            <p class="text-placeholder p-4">Functionaliteit werkt nog niet.</p>
        </div>

        <div id="likes" class="flex tab-content hidden justify-center items-center">
            <p class="text-placeholder p-4">Functionaliteit werkt nog niet.</p>
        </div>
    </div>

    @auth
    @include("components.profile._update_profile_modal")
    @endauth
</div>

<script type="text/javascript">

    function passProfileContent(userBio, userWebsite) {
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
