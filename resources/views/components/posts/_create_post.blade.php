<div class="space-y-4 w-full max-w-4xl mx-auto p-4 bg-content_bg rounded-3xl border border-divider mb-4">
    <div class="flex items-center mb-2">
        <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('https://eu.ui-avatars.com/api/?name=John+Doe&size=250') }}" alt="Profielfoto" class="rounded-full w-10 h-10 mr-3 border-2 border-divider">
        <div>
            <a href="/profile/{{ auth()->user()->username }}" class="font-bold text-lg text-white lowercase">{{ auth()->user()->username }}</a>
            <div class="text-placeholder text-sm">Everyone can reply</div>
        </div>
    </div>
    <form method="post" action="/posts" enctype="multipart/form-data" class="-pt-8">
        @csrf    
        <input type="hidden" name="quote_id" id="quote_id" value="" />
        <div class="mb-2">
            <input placeholder="What are you thinking about?" name="content" id="postInput" class="w-full bg-content_bg text-white placeholder-placeholder pl-2 rounded-lg focus:outline-none grow" placeholder="What are you thinking about?">
        </div>
        <div id="quotedPostContainer" class="relative hidden bg-content_bg p-3 rounded-lg mb-4 border border-divider">
            <div class="flex items-center mb-4 w-full">
                <img id="quotedPostProfilePicture" alt="Profielfoto" class="rounded-full w-10 h-10 mr-3">
                <div>
                    <div class="text-white" id="quotedPostUsername"></div>
                    <div class="text-placeholder text-xs">quoted post</div>
                </div>
            </div>
            <div class="text-gray-300" id="quotedPostContent"></div>
            <button type="button" id="removeQuotedPostButton" class="text-xs bg-content rounded-md border border-divider p-1 absolute top-0 right-0 mt-2 mr-2 text-white">Remove</button>
        </div>
        <div class="mb-4">
            <img id="imagePreview" src="#" alt="Image Preview" class="hidden w-auto max-h-96 rounded-lg border-2 border-divider">
        </div>
        <div class="flex space-x-2 ml-2">
            <label for="image_one" class="cursor-pointer">
                <input type="file" id="image_one" name="image_one" class="focus:outline-none hidden ml-1" accept="image/*" onchange="previewImage(event)">
                <svg width="26px" height="26px" viewBox="0 1 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.2639 15.9375L12.5958 14.2834C11.7909 13.4851 11.3884 13.086 10.9266 12.9401C10.5204 12.8118 10.0838 12.8165 9.68048 12.9536C9.22188 13.1095 8.82814 13.5172 8.04068 14.3326L4.04409 18.2801M14.2639 15.9375L14.6053 15.599C15.4112 14.7998 15.8141 14.4002 16.2765 14.2543C16.6831 14.126 17.12 14.1311 17.5236 14.2687C17.9824 14.4251 18.3761 14.8339 19.1634 15.6514L20 16.4934M14.2639 15.9375L18.275 19.9565M18.275 19.9565C17.9176 20 17.4543 20 16.8 20H7.2C6.07989 20 5.51984 20 5.09202 19.782C4.71569 19.5903 4.40973 19.2843 4.21799 18.908C4.12796 18.7313 4.07512 18.5321 4.04409 18.2801M18.275 19.9565C18.5293 19.9256 18.7301 19.8727 18.908 19.782C19.2843 19.5903 19.5903 19.2843 19.782 18.908C20 18.4802 20 17.9201 20 16.8V16.4934M4.04409 18.2801C4 17.9221 4 17.4575 4 16.8V7.2C4 6.0799 4 5.51984 4.21799 5.09202C4.40973 4.71569 4.71569 4.40973 5.09202 4.21799C5.51984 4 6.07989 4 7.2 4H16.8C17.9201 4 18.4802 4 18.908 4.21799C19.2843 4.40973 19.5903 4.71569 19.782 5.09202C20 5.51984 20 6.0799 20 7.2V16.4934M17 8.99989C17 10.1045 16.1046 10.9999 15 10.9999C13.8954 10.9999 13 10.1045 13 8.99989C13 7.89532 13.8954 6.99989 15 6.99989C16.1046 6.99989 17 7.89532 17 8.99989Z" stroke="#3A3E41" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </label>
            <label for="poll" class="cursor-pointer">
                <input  id="poll" name="poll" class="focus:outline-none hidden ml-1" >
                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M19 4H5C4.44771 4 4 4.44772 4 5V19C4 19.5523 4.44772 20 5 20H19C19.5523 20 20 19.5523 20 19V5C20 4.44771 19.5523 4 19 4ZM5 2C3.34315 2 2 3.34315 2 5V19C2 20.6569 3.34315 22 5 22H19C20.6569 22 22 20.6569 22 19V5C22 3.34315 20.6569 2 19 2H5Z"
                    fill="#3A3E41"
                  />
                  <path d="M11 7H13V17H11V7Z" fill="#3A3E41" />
                  <path d="M15 13H17V17H15V13Z" fill="#3A3E41" />
                  <path d="M7 10H9V17H7V10Z" fill="#3A3E41" />
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

<style>
    .mention-blue {
        color: #1DA1F2;
    }
</style>

<script type="text/javascript">
    const postInput = document.getElementById('postInput');
    const postButton = document.getElementById('postButton');
    const imageInput = document.getElementById('image_one');
    const imagePreview = document.getElementById('imagePreview');
    const quotedPostContainer = document.getElementById('quotedPostContainer');
    const quotedPostUsername = document.getElementById('quotedPostUsername');
    const quotedPostContent = document.getElementById('quotedPostContent');
    const quotedPostImage = document.getElementById('quotedPostImage');
    const quoteIdInput = document.getElementById('quote_id');
    const quotedPostProfilePicture = document.getElementById('quotedPostProfilePicture');
    const removeQuotedPostButton = document.getElementById('removeQuotedPostButton');

    let quoteSet = false;

    function extractQuoteIdFromContent(content) {
        const regex = /\/([^/]+)\/([a-zA-Z0-9_]+)/;
        const match = content.match(regex);
        if (match) {
            return {
                username: match[1],
                postId: match[2]
            };
        }
        return null;
    }

    async function fetchQuotedPostByUUID(uuid) {
        try {
            const response = await fetch(`/api/posts/uuid/${uuid}`);
            if (response.ok) {
                const post = await response.json();
                return post;
            }
            return null;
        } catch (error) {
            console.error('Error fetching quoted post:', error);
            return null;
        }
    }

    async function displayQuotedPost() {
        const content = postInput.textContent;
        if (!quoteSet) {
            const quoteDetails = extractQuoteIdFromContent(content);
            if (quoteDetails) {

                // console.log('Quote details:', quoteDetails);

                const quotedPost = await fetchQuotedPostByUUID(quoteDetails.postId);

                if (quotedPost) {
                    // console.log('Quoted post:', quotedPost);
                    quotedPostUsername.textContent = `${quotedPost.user.username}`;
                    quotedPostContent.textContent = quotedPost.content;
                    quoteIdInput.value = quotedPost.id;

                    if (quotedPost.user.profile_picture) {
                        // console.log('Profile picture URL:', quotedPost.user.profile_picture);
                        quotedPostProfilePicture.src = `/storage/${quotedPost.user.profile_picture}`;
                    } else {
                        // console.log('Profile picture not found, using default');
                        quotedPostProfilePicture.src = 'https://eu.ui-avatars.com/api/?name=John+Doe&size=250';
                    }

                    quotedPostContainer.classList.remove('hidden');

                    postInput.textContent = content.replace(/(?:https?:\/\/(?:localhost:8000|cit-y\.com))?\/([^/]+)\/([a-zA-Z0-9_]+)/, '').trim();
                    quoteSet = true;
                } else {
                    // console.log('Quoted post not found');
                    quotedPostContainer.classList.add('hidden');
                    quoteIdInput.value = '';
                    quoteSet = false;
                }
            } else {
                // console.log('No quote details found');
                quotedPostContainer.classList.add('hidden');
                quoteIdInput.value = '';
                quoteSet = false;
            }
        }
    }

    removeQuotedPostButton.addEventListener('click', () => {
        quotedPostContainer.classList.add('hidden');
        quoteIdInput.value = '';
        postInput.textContent = '';
        quoteSet = false;
    });

    // Add event listener to the input field
    postInput.addEventListener('input', () => {
        toggleButtonState();
        displayQuotedPost();
    });

    function toggleButtonState() {
        if (postInput.textContent.trim() === '') {
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

    toggleButtonState();
</script>
