<div class="space-y-4 w-full max-w-4xl mx-auto p-4 bg-content_bg rounded-lg border border-divider mb-4">
    <div class="flex items-center mb-2">
        <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('https://eu.ui-avatars.com/api/?name=John+Doe&size=250') }}" alt="Profielfoto" class="rounded-full w-10 h-10 mr-3 border-2 border-divider">
        <div>
            <a href="/profile/{{ auth()->user()->username }}" class="font-bold text-lg text-white lowercase">{{ auth()->user()->username }}</a>
            <div class="text-placeholder text-sm">Everyone can reply</div>
        </div>
    </div>
    <form method="post" action="/posts" enctype="multipart/form-data" class="-pt-8">
        @csrf
        <div class="mb-2">
            <input name="content" id="postInput" autocomplete="off" type="text" placeholder="What are you thinking about?" class="w-full bg-content_bg text-white placeholder-placeholder pl-2 rounded-lg focus:outline-none grow">
        </div>
        <div class="mb-4">
            <img id="imagePreview" src="#" alt="Image Preview" class="hidden w-auto max-h-96 rounded-lg border-2 border-divider">
        </div>
        <div class="flex space-x-4 text-blue-400 ml-2">
            <label for="image_one" class="cursor-pointer">
                <input type="file" id="image_one" name="image_one" class="focus:outline-none hidden ml-1" accept="image/*" onchange="previewImage(event)">
                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.2639 15.9375L12.5958 14.2834C11.7909 13.4851 11.3884 13.086 10.9266 12.9401C10.5204 12.8118 10.0838 12.8165 9.68048 12.9536C9.22188 13.1095 8.82814 13.5172 8.04068 14.3326L4.04409 18.2801M14.2639 15.9375L14.6053 15.599C15.4112 14.7998 15.8141 14.4002 16.2765 14.2543C16.6831 14.126 17.12 14.1311 17.5236 14.2687C17.9824 14.4251 18.3761 14.8339 19.1634 15.6514L20 16.4934M14.2639 15.9375L18.275 19.9565M18.275 19.9565C17.9176 20 17.4543 20 16.8 20H7.2C6.07989 20 5.51984 20 5.09202 19.782C4.71569 19.5903 4.40973 19.2843 4.21799 18.908C4.12796 18.7313 4.07512 18.5321 4.04409 18.2801M18.275 19.9565C18.5293 19.9256 18.7301 19.8727 18.908 19.782C19.2843 19.5903 19.5903 19.2843 19.782 18.908C20 18.4802 20 17.9201 20 16.8V16.4934M4.04409 18.2801C4 17.9221 4 17.4575 4 16.8V7.2C4 6.0799 4 5.51984 4.21799 5.09202C4.40973 4.71569 4.71569 4.40973 5.09202 4.21799C5.51984 4 6.07989 4 7.2 4H16.8C17.9201 4 18.4802 4 18.908 4.21799C19.2843 4.40973 19.5903 4.71569 19.782 5.09202C20 5.51984 20 6.0799 20 7.2V16.4934M17 8.99989C17 10.1045 16.1046 10.9999 15 10.9999C13.8954 10.9999 13 10.1045 13 8.99989C13 7.89532 13.8954 6.99989 15 6.99989C16.1046 6.99989 17 7.89532 17 8.99989Z" stroke="#3A3E41" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </label>
        </div>
        <div class="flex justify-end">
            <div class="flex space-x-2 text-blue-400 ml-2">
                <!-- Add other icons or elements here if needed -->
            </div>
            <button id="postButton" class="bg-content_bg text-white font-bold py-2 px-4 rounded-full focus:outline-none border border-divider">
                Post
            </button>
        </div>
    </form>
</div>

<script type="text/javascript">
    const postInput = document.getElementById('postInput');
    const postButton = document.getElementById('postButton');
    const imageInput = document.getElementById('image_one');
    const imagePreview = document.getElementById('imagePreview');

    function toggleButtonState() {
        if (postInput.value.trim() === '') {
            postButton.classList.remove('cursor-pointer', 'text-white');
            postButton.classList.add('cursor-default', 'text-divider');
        } else {
            postButton.classList.remove('cursor-default', 'text-divider');
            postButton.classList.add('cursor-pointer', 'text-white');
        }
    }

    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '#';
            imagePreview.classList.add('hidden');
        }
    }

    // Check the input on page load
    toggleButtonState();

    // Add event listener to the input field
    postInput.addEventListener('input', toggleButtonState);
</script>
