<div
    data-twe-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
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
                        <img id="bannerPreview" class="w-full h-full object-cover" src="{{ $user->banner ? asset('storage/' . $user->banner) : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=' }}" alt="Banner Preview">
                        @if( $user->banner == null)
                        <p class="flex -mt-48 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload banner</span></p>
                        <p class="flex mt-2 text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (RECOMMENDED. 1500x400px)</p>
                        @endif
                        <input id="banner" name="banner" type="file" class="hidden" accept="image/*"/>
                    </label>
                </div>
                <div class="flex items-left justify-left mt-4 p-2 w-4/5">
                    <label for="profile_picture" class="flex flex-col items-left justify-left h-32 cursor-pointer rounded-full bg-background">
                        <img id="profilePicturePreview" class="w-32 h-32 rounded-full" src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('https://eu.ui-avatars.com/api/?name=John+Doe&size=250') }}" alt="Profile Picture Preview">
                        <input id="profile_picture" name="profile_picture" type="file" class="hidden" accept="image/*" />
                    </label>
                </div>
                <div class="flex items-center border border-divider mt-8 space-x-1 p-2 m-2 rounded">
                    <input name="firstname" id="firstname" placeholder="First Name" class="placeholder-placeholder w-full bg-content_bg text-white rounded-lg focus:outline-none" />
                    <input name="lastname" id="lastname" placeholder="Last Name" class="placeholder-placeholder w-full bg-content_bg text-white rounded-lg focus:outline-none" />
                </div>
                <div class="flex items-center border border-divider mt-8 p-2 m-2 rounded">
                    <textarea name="bio" id="bio" placeholder="Bio" class="placeholder-placeholder w-full bg-content_bg text-white rounded-lg focus:outline-none"></textarea>
                </div>
                <div class="flex items-center border border-divider p-2 mt-4 mb-4 m-2 rounded">
                    <input type="url" name="website" id="website" placeholder="Website" class="placeholder-placeholder w-full bg-content_bg text-white rounded-lg focus:outline-none">
                    @error('url')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>

                <!-- Modal footer -->
                <div class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-divider p-4 dark:border-white/10">
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
    const bannerInput = document.getElementById('banner');
    const bannerPreview = document.getElementById('bannerPreview');
    const profilePictureInput = document.getElementById('profile_picture');
    const profilePicturePreview = document.getElementById('profilePicturePreview');

    editProfileButton.addEventListener('click', function () {
        editProfileForm.submit();
    });

    bannerInput.addEventListener('change', function () {
        const file = bannerInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                bannerPreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    profilePictureInput.addEventListener('change', function () {
        const file = profilePictureInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                profilePicturePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
