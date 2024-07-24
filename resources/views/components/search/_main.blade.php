<div class="max-w-4xl p-8 mx-auto h-auto bg-content_bg rounded-3xl mb-4 border border-divider relative">
    <form id="searchForm" action="{{ route('explore.search') }}" method="GET">   
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="search" name="search" id="searchInput" autocomplete="off" value="{{ request('search') }}" class="block w-full outline-none p-4 pl-10 text-sm text-white rounded-lg bg-background focus:border focus:border-liked_by " placeholder="Explore Posts, Citizens..." required>
            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-content_bg hover:bg-divider active:bg-background focus:outline-none font-medium rounded-lg text-sm px-4 py-2">Explore</button>
        </div>
    </form>
</div>
@include("components.search._results")
