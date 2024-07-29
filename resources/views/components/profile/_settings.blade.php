<ul class="absolute z-[1000] float-left m-0 hidden min-w-max shadow-xxl list-none overflow-hidden rounded-lg border-none bg-content_bg bg-clip-padding text-base data-[twe-dropdown-show]:block"
    aria-labelledby="profileSettingsDropdown"
    data-twe-dropdown-menu-ref>
    @if(auth()->user()->hasBlocked($user))
        <li>
            <form action="{{ route('unblock.user', $user) }}" method="POST">
                @csrf
                <button type="submit" class="inline-block w-full px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white transition duration-150 ease-in-out bg-liked_by hover:bg-background focus:outline-none">
                    Unblock
                </button>
            </form>
        </li>
    @else
        <li>
            <form action="{{ route('block.user', $user) }}" method="POST">
                @csrf
                <button type="submit" class="inline-block w-full px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white transition duration-150 ease-in-out bg-liked_by hover:bg-background focus:outline-none">
                    Block
                </button>
            </form>
        </li>
    @endif
</ul>
