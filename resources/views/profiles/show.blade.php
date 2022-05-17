<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-around">
            <a href="{{route('dashboard')}}"><h2 class="mx-5  text-xl text-gray-400 leading-tight hover:text-blue-700">タイムライン</h2></a>
            <a href="{{route('tweet.create')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight hover:text-blue-700">ツイートする</h2></a>
            <a href="{{route('user.index')}}"><h2 class="mx-5 font-semibold text-xl text-gray-800 leading-tight hover:text-blue-700">ユーザー一覧</h2></a>
            <a href="{{route('profile.index')}}"><h2 class="mx-5  text-xl text-gray-400 leading-tight hover:text-blue-700">マイページ</h2></a>
        </div> 
    </x-slot>
    
    <div class="w-11/12 max-w-screen-md m-auto">
        <div class="my-5">
            @if(is_null($user->UserProfile->header_image))
                <img class="w-15 h-15 rounded" src="{{asset('images/no_image.png')}}" width="100" height="100">
            @else
                <img class="w-15 h-15 rounded" src="{{asset($user->UserProfile->header_image)}}" width="100" height="100">
            @endif
        </div>

        <div class="max-w-screen-md m-auto bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-end mr-3">
                @if($user->id !== Auth::id())
                    @if(!$user->canFollow($user->id))
                        <button data-user-id="{{$user->id}}" id="{{$user->id}}" class="follow pushedUnFollow inline-flex items-center px-4 py-2 my-5 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">フォロー</button>
                    @else
                        <button data-user-id="{{$user->id}}" id="{{$user->id}}" class="follow pushedFollow inline-flex items-center px-4 py-2 my-5 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">フォロー解除</button>
                    @endif
                @endif
            </div>
            <div class="flex">
                <div class="m-5">
                    @if(empty($user->UserProfile->icon_image))
                        <img class="w-20 h-20 rounded-full border" src="{{asset('images/no_image.png')}}">
                    @else
                        <img class="w-20 h-20 rounded-full border" src="{{asset($user->UserProfile->icon_image)}}">
                    @endif
                </div>
                <div class="my-5">
                    {{$user->UserProfile->screen_name}}
                    <br>
                    {{$user->UserProfile->description}}
                    <br>
                    {{$user->UserProfile->location}}
                    <br>
                    {{$user->UserProfile->url}}
                    <br>

                    <div class="flex justify-around space-x-4">
                        <a href="{{route('follow.show',['id' => $user->id])}}">フォロー数:{{$user->followCount($user->id)}}</a>
                        <a href="{{route('follower.show',['id' => $user->id])}}">フォロワー数:{{$user->followerCount($user->id)}}</a>
                        <a href="{{route('favorite.tweets',['id' => $user->id])}}">いいねしたツイート:{{$user->favoriteCount($user->id)}}</a>
                    </div>
                </div>
            </div>
        </div>
    
        {{-- tweet表示 --}}

        <div class="max-w-screen-md m-auto mt-5 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            @foreach($user->tweets as $tweet)
            <div class="border py-5">
                <a href="{{route('tweet.show',['id' => $tweet->id])}}">
                    <div class="flex focus:outline-none">
                        <div class="m-5">
                            @if(empty($user->UserProfile->icon_image))
                                <img class="w-20 h-20 rounded-full border" src="{{asset('images/no_image.png')}}">
                            @else
                                <img class="w-20 h-20 rounded-full border" src="{{asset($user->UserProfile->icon_image)}}">
                            @endif
                        </div>
                        <div class="my-5 font-semibold">{{ $tweet->user->userProfile->screen_name }}</div>
                    </div>
                    <div class="my-5 ml-5">{{ $tweet->content }}</div>
                    <div class=" flex justify-around">
                        @if(!is_null($tweet->image))
                        <img class="w-20 h-20 rounded" src="{{asset($tweet->image)}}">
                        @endif
                    </div>
                    <div class="flex justify-end m-5 text-s">{{ $tweet->updated_at }}</div>
                </a>
                <div class="flex">
                    @if(!$user->canFavorite($tweet->id))                                        
                        <button data-tweet-id="{{$tweet->id}}" id="{{$tweet->id}}" class="favorite btn">いいね</button>
                    @else
                        <button data-tweet-id="{{$tweet->id}}" id="{{$tweet->id}}" class="favorite pushedFavorite">いいね</button>
                    @endif
                    <div class="mt-2">
                        <a href="{{route('tweet.show',['id' => $tweet->id])}}" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-900">リプする</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
