
<ul
class="absolute z-[1000] float-left m-0 hidden min-w-max shadow-xxl list-none overflow-hidden rounded-lg border-none bg-content_bg bg-clip-padding text-base data-[twe-dropdown-show]:block"
aria-labelledby="editSettingsDropdown"
data-twe-dropdown-menu-ref>
    <li>
        <a
        class="inline-block w-full px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white transition duration-150 ease-in-out hover:bg-background focus:bg-background focus:outline-none"
        onclick="event.stopPropagation(), pinPost({{ $post->id }}, {{ auth()->user()->pinned_post_id == $post->id ? 'true' : 'false' }})">
        Pin Post
        </a>
    </li>
    <li>
        <a
        class="inline-block w-full px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white transition duration-150 ease-in-out hover:bg-background focus:bg-background focus:outline-none"
        onclick="event.stopPropagation()"
        data-twe-toggle="modal"
        data-twe-target="#editPostModal"
        data-twe-ripple-init
        data-twe-ripple-color="light"
        data-twe-dropdown-item-ref>
        Edit Post
        </a>
    </li>
    <li>
        <a
        class="inline-block px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white transition duration-150 ease-in-out hover:bg-background focus:bg-background focus:outline-none "
        onclick="event.stopPropagation()"
        data-twe-toggle="modal"
        data-twe-target="#deletePostModal"
        data-twe-ripple-init
        data-twe-ripple-color="light"
        data-twe-dropdown-item-ref>
        Delete Post
        </a>
    </li>
</ul>

<script>
    function pinPost(postId, isPinned) {
        fetch(`/posts/pin/${postId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                pin: !isPinned
            })
        })
        .then(response => {
            console.log('Response status:', response.status);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data);
            if (data.status === 'success') {
                // Show the pinned alert
                showPinnedAlert();
            } else {
                alert('Failed to pin the post');
            }
        })
    }
</script>
