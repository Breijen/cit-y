<div
    data-twe-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none "
    id="createCommentModal"
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
            Reply
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
        <form id="createCommentForm" method="POST" enctype="multipart/form-data" action="{{ route('comments.store', $post->id) }}">
        @csrf
         
        <div class="flex mb-4 p-4">
            <img src="{{auth()->user()->profile_picture ? asset('storage/' . auth()->user()['profile_picture']) : asset('https://eu.ui-avatars.com/api/?name=John+Doe&size=250')}}" alt="Profielfoto" class="rounded-full w-10 h-10 mr-3 border-2 border-divider">
            <div>
                <a href="/profile/{{auth()->user()->username}}" class="font-bold text-lg text-white">{{auth()->user()->username}}</a>
                <div class="mb-2">
                    <input name="content" id="postInput" autocomplete="off" type="text" placeholder="Waar denk je aan?" class="w-full bg-content_bg text-white placeholder-placeholder rounded-lg focus:outline-none grow">
                </div>
                <div class="mb-4">
                    <img id="commentImagePreview" src="#" alt="Image Preview" class="hidden w-auto max-h-96 rounded-lg border-2 border-divider">
                </div>
            </div>
        </div>
            <div class="flex items-center justify-between">
                <div class="flex space-x-4 text-blue-400">
                    <label for="commentImageOne" class="cursor-pointer ml-4">
                        <input type="file" id="commentImageOne" name="commentImageOne" class="focus:outline-none hidden ml-1" onchange="previewCommentImage(event)"/>
                        <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.2639 15.9375L12.5958 14.2834C11.7909 13.4851 11.3884 13.086 10.9266 12.9401C10.5204 12.8118 10.0838 12.8165 9.68048 12.9536C9.22188 13.1095 8.82814 13.5172 8.04068 14.3326L4.04409 18.2801M14.2639 15.9375L14.6053 15.599C15.4112 14.7998 15.8141 14.4002 16.2765 14.2543C16.6831 14.126 17.12 14.1311 17.5236 14.2687C17.9824 14.4251 18.3761 14.8339 19.1634 15.6514L20 16.4934M14.2639 15.9375L18.275 19.9565M18.275 19.9565C17.9176 20 17.4543 20 16.8 20H7.2C6.07989 20 5.51984 20 5.09202 19.782C4.71569 19.5903 4.40973 19.2843 4.21799 18.908C4.12796 18.7313 4.07512 18.5321 4.04409 18.2801M18.275 19.9565C18.5293 19.9256 18.7301 19.8727 18.908 19.782C19.2843 19.5903 19.5903 19.2843 19.782 18.908C20 18.4802 20 17.9201 20 16.8V16.4934M4.04409 18.2801C4 17.9221 4 17.4575 4 16.8V7.2C4 6.0799 4 5.51984 4.21799 5.09202C4.40973 4.71569 4.71569 4.40973 5.09202 4.21799C5.51984 4 6.07989 4 7.2 4H16.8C17.9201 4 18.4802 4 18.908 4.21799C19.2843 4.40973 19.5903 4.71569 19.782 5.09202C20 5.51984 20 6.0799 20 7.2V16.4934M17 8.99989C17 10.1045 16.1046 10.9999 15 10.9999C13.8954 10.9999 13 10.1045 13 8.99989C13 7.89532 13.8954 6.99989 15 6.99989C16.1046 6.99989 17 7.89532 17 8.99989Z" stroke="#3A3E41" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </label>

                    <button class="focus:outline-none">

                    </button>
                    <button class="focus:outline-none">

                    </button>
                    <button class="focus:outline-none">
  
                    </button>
                    <button class="focus:outline-none">

                    </button>
                </div>
                <button id="createCommentButton" class="mr-2 bg-content_bg text-white font-bold py-2 px-4 rounded-full focus:outline-none border border-divider">
                    Post
                </button>
            </div>
        </form>
    </div>
    </div>
</div>

<script type="text/javascript">
    const createCommentForm = document.getElementById('createCommentForm');
    const createCommentButton = document.getElementById('createCommentButton');

    const commentImageInput = document.getElementById('commentImageOne');
    const commentImagePreview = document.getElementById('commentImagePreview');

    createCommentButton.addEventListener('click', function () {
        createCommentForm.submit();
    });

    function previewCommentImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                commentImagePreview.src = e.target.result;
                commentImagePreview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            commentImagePreview.src = '#';
            commentImagePreview.classList.add('hidden');
        }
    }
</script>
