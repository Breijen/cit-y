<div
    data-twe-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none "
    id="editProfileModal"
    tabindex="-1"
    role="dialog">
    <div
    data-twe-modal-dialog-ref
    class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
    <div
        class="pointer-events-auto relative flex w-full flex-col rounded-md border border-divider bg-content_bg bg-clip-padding shadow-4 outline-none">
        <div
        class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-divider p-4">
        <!-- Modal title -->
        <h5
            class="text-xl font-medium leading-normal text-surface text-white"
            id="exampleModalCenterTitle">
            Edit Profile
        </h5>
        <!-- Close button -->
        <button
            type="button"
            class="box-content rounded-none border-none text-icons hover:text-selected hover:no-underline focus:text-neutral-800 focus:opacity-100 focus:outline-none"
            data-twe-modal-dismiss
            aria-label="Close">
            <span class="[&>svg]:h-6 [&>svg]:w-6">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor">
                <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M6 18L18 6M6 6l12 12" />
            </svg>
            </span>
        </button>
        </div>

        <!-- Modal body -->
        <form id="profileEditForm" method="post" enctype="multipart/form-data" action="{{ route('profile.update', $user->id) }}">
        @csrf        
        @method('PUT')
            <div class="flex items-center justify-center w-full">
                <label for="banner" class="flex flex-col items-center justify-center w-full h-48 cursor-pointer bg-background">
                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload banner</span></p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (RECOMMENDED. 1500x400px)</p>
                    <input id="banner" name="banner" type="file" class="hidden"/>
                </label>
            </div> 
            <div class="flex flex-col space-y-4 p-2">
                <div class="flex items-left justify-left w-full">
                    <label for="profile_picture" class="flex flex-col items-left justify-left h-36 cursor-pointer bg-content_bg">
                        <img class="w-32 h-32 rounded-full" src="https://placehold.co/150x150/080C0C/FFF?font=open_sans" alt="Profile Picture">
                        <input id="profile_picture" name="profile_picture" type="file" class="hidden" />
                    </label>
                </div> 
                <div class="flex items-center border border-divider p-2 rounded">
                    <textarea name="bio" id="bio" placeholder="Bio" class="placeholder-placeholder w-full bg-content_bg text-white rounded-lg focus:outline-none"></textarea>
                </div>
                <div class="flex items-center border border-divider p-2 rounded">
                    <input type="url" name="website" id="website" placeholder="Website" class="placeholder-placeholder w-full bg-content_bg text-white rounded-lg focus:outline-none">
                    @error('url')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
                </div>
            </div>

            <!-- Modal footer -->
            <div
                class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-divider p-4 dark:border-white/10">
                <button
                    type="button"
                    id="editProfileButton"
                    class="bg-content_bg text-white font-bold py-2 px-4 rounded-full focus:outline-none border border-divider"
                    data-twe-ripple-init
                    data-twe-ripple-color="light">
                    Save
                </button>
                
            </div>
        </form>
    </div>
    </div>
</div>

<script type="text/javascript">
    const editProfileForm = document.getElementById('profileEditForm');
    const editProfileButton = document.getElementById('editProfileButton');

    editProfileButton.addEventListener('click', function () {
        editProfileForm.submit();
    });
</script>
