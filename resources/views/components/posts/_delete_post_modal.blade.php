<div
    data-twe-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none "
    id="deletePostModal"
    tabindex="-1"
    role="dialog">
    <div
    data-twe-modal-dialog-ref
    class="pointer-events-none  relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
    <div
        class="pointer-events-auto relative flex w-full flex-col rounded-md border border-divider bg-content_bg bg-clip-padding shadow-4 outline-none">
        <div
        class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-divider p-4">
        <!-- Modal title -->
        <h5
            class="text-xl font-medium leading-normal text-surface text-white"
            id="exampleModalCenterTitle">
            Delete post?
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
        <form id="postDeleteForm" method="POST">
        @csrf
        @method('DELETE')
            <div class="flex items-center mb-4 p-4 text-white">
                <p>If you delete this post, you won't be able to restore it.</p>
            </div>

            <!-- Modal footer -->
            <div
                class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-divider p-4 dark:border-white/10">
                <button
                    type="button"
                    id="deleteButton"
                    class="bg-content_bg text-white font-bold py-2 px-4 rounded-full focus:outline-none border border-divider"
                    data-twe-ripple-init
                    data-twe-ripple-color="light"
                    onclick="console.log('Button clicked')">
                    Delete
                </button>
                
            </div>
        </form>
    </div>
    </div>
</div>

<script type="text/javascript">
    const deleteForm = document.getElementById('postDeleteForm');
    const deleteButton = document.getElementById('deleteButton');

    deleteButton.addEventListener('click', function () {
        deleteForm.submit();
    });
</script>
