<div class="min-h-screen">
    <div class="space-y-2 w-full max-w-4xl mx-auto p-4 bg-content_bg rounded-lg border border-divider">
        <div class="posts">
            @foreach($posts as $post)
                @if($post->comments->count() > 0)
                    @foreach($post->comments as $comment)
                        @if($comment->user->id !== auth()->user()->id)
                        <div class="pb-4 p-2">
                            <div class="pb-4 cursor-pointer" onclick="location.href='/{{$post['username']}}/{{$post['uuid']}}'">
                                <div class="flex items-center mb-1" >
                                    <img src="{{$comment->user->profile_picture ? asset('storage/' . $comment->user->profile_picture) : asset('https://eu.ui-avatars.com/api/?name=John+Doe&size=250')}}" alt="Profielfoto" class="rounded-full w-10 h-10 mr-3">
                                    <div>
                                        <div class="flex">
                                            <a href="/profile/{{$comment->user->username}}" class="font-bold text-md text-white hover:underline">
                                            {{$comment->user->username}} 
                                            </a>
                                            <p class="text-gray-400 pl-1 pt-[2px] text-placeholder text-sm">
                                            @php
                                                $now = new DateTime();
                                                $ago = new DateTime($comment->created_at);
                                                $diff = $now->diff($ago);

                                                if ($diff->y > 0) {
                                                    echo $diff->y . 'y';
                                                } elseif ($diff->m > 0) {
                                                    echo $diff->m . 'm';
                                                } elseif ($diff->d > 0) {
                                                    echo $diff->d . 'd';
                                                } elseif ($diff->h > 0) {
                                                    echo $diff->h . 'h';
                                                } elseif ($diff->i > 0) {
                                                    echo $diff->i . 'm';
                                                } else {
                                                    echo $diff->s . 's';
                                                }
                                            @endphp
                                            </p>
                                        </div>
                                        <div class="text-placeholder text-xl">
                                        {{$post["content"]}}
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <p class="px-[50px] text-gray-300 text-xl">{{$comment['content']}}</p>
                                </div>
                            </div>
                            <hr class="border-divider">
                        </div>
                      @endif
                @endforeach
                @endif
            @endforeach
            @foreach($posts as $post)
                    @if($post->likedBy->count() > 0)
                        @if($mostRecentLike = $post->likedBy->where('pivot.user_id', '!=', Auth::id())->first())
                        <div class="pb-4 p-2">
                            <div class="pb-4 cursor-pointer" onclick="location.href='/{{$post['username']}}/{{$post['uuid']}}'">
                                <div class="flex items-center mb-1" >
                                    <img src="{{$comment->user->profile_picture ? asset('storage/' . $comment->user->profile_picture) : asset('https://eu.ui-avatars.com/api/?name=John+Doe&size=250')}}" alt="Profielfoto" class="rounded-full w-10 h-10 mr-3">
                                    <div>
                                        <div class="flex">
                                            @if($post->likedBy->count() > 1)
                                            <a href="/profile/{{$comment->user->username}}" class="font-bold text-md text-white hover:underline">
                                            {{ $mostRecentLike->username }} &nbsp;
                                            </a>
                                            <p class="font-bold text-md text-placeholder hover:underline">and {{ $post->likedBy->count() - 1 }} others</p>
                                            @else
                                            <a href="/profile/{{$comment->user->username}}" class="font-bold text-md text-white hover:underline">
                                            {{ $mostRecentLike->username }}
                                            </a>
                                            @endif
                                            <p class="text-placeholder pl-1 pt-[2px] text-placeholder text-sm">
                                            @php
                                                $now = new DateTime();
                                                $ago = new DateTime($comment->created_at);
                                                $diff = $now->diff($ago);

                                                if ($diff->y > 0) {
                                                    echo $diff->y . 'y';
                                                } elseif ($diff->m > 0) {
                                                    echo $diff->m . 'm';
                                                } elseif ($diff->d > 0) {
                                                    echo $diff->d . 'd';
                                                } elseif ($diff->h > 0) {
                                                    echo $diff->h . 'h';
                                                } elseif ($diff->i > 0) {
                                                    echo $diff->i . 'm';
                                                } else {
                                                    echo $diff->s . 's';
                                                }
                                            @endphp
                                            </p>
                                        </div>
                                        <div class="text-placeholder text-xl">
                                        {{$post["content"]}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="border-divider">
                        </div>
                      @endif
                @endif
            @endforeach
        </div>
    </div>
</div>


