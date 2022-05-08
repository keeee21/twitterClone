<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-around">
            <a href="{{route('dashboard')}}"><h2 class="mx-5  text-xl text-gray-400 leading-tight">タイムライン</h2></a>
            <a href="{{route('tweet.create')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight">ツイートする</h2></a>
            <a href="{{route('user.index')}}"><h2 class="mx-5  text-xl text-gray-400 leading-tight">ユーザー一覧</h2></a>
            <a href="{{route('profile.index')}}"><h2 class="mx-5 font-semibold text-xl text-gray-800 leading-tight">マイページ</h2></a>
        </div>   
    </x-slot>
    
    <div flex justify-around items-center>
        <div class="w-11/12 max-w-screen-md m-auto">
            <div>
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="my-5 p-5 border bg-white">
                    <div class="flex justify-end">
                        <a href="{{route('profile.edit')}}" class="inline-flex items-center px-4 py-2 bg-white-800 border border-blue-700 border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:text-white hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150" >プロフィールを編集する</a>
                    </div>
                    <div class="mb-8 w-full">
                        @if(empty($user->UserProfile->header_image))
                            <img class="w-full round border" src="{{asset('storage/images/no_image.png')}}" width="100" height="100">
                        @else
                            <img class="w-full round border" src="{{asset($user->UserProfile->header_image)}}" width="100" height="100">
                        @endif
                    </div>
                    <div class="mb-8">
                        <div>
                            @if(empty($user->UserProfile->icon_image))
                                <img class="w-20 h-20 rounded-full border" src="{{asset('storage/images/no_image.png')}}" width="100" height="100">
                            @else
                                <img class="w-20 h-20 rounded-full border" src="{{asset($user->UserProfile->icon_image)}}" width="100" height="100">
                            @endif
                        </div>
                    </div>
                    <div class="mb-8">
                        <label for="screen_name" class="text-sm block">アカウント名</label>
                        <div class="w-full border-b bg-white focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-opacity-50">{{$user->UserProfile->screen_name}}</div>
                    </div>
                    <div class="mb-8">
                        <label for="description" class="text-sm block">自己紹介</label>
                            <div class="w-full border-b bg-white focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-opacity-50">{{$user->UserProfile->description}}</div>
                    </div>
                    <div class="mb-8">
                        <label for="location" class="text-sm block">場所</label>
                        <div class="w-full border-b bg-white focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-opacity-50">{{$user->UserProfile->location}}</div>
                    </div>
                    <div class="mb-8">
                        <label for="url" class="text-sm block">URL</label>
                        <div class="w-full border-b bg-white focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-opacity-50">{{$user->UserProfile->url}}</div>
                    </div>
                    <div class="flex justify-around">
                        <a href="{{route('follow.show')}}">フォロー数:{{$user->followCount()}}</a>
                        <a href="{{route('follower.show')}}">フォロワー数:{{$user->followerCount()}}</a>
                        <a href="{{route('favorite.tweets')}}">いいねしたツイート:{{$user->favoriteCount()}}</a>
                    </div>
                </div>
                <div class="max-w-screen-md m-auto my-5 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    @foreach($user->tweets as $tweet)
                        <div class="border py-5">
                            <a href="{{route('tweet.show',['id' => $tweet->id])}}">
                                <div class="flex focus:outline-none">
                                    <div class="m-5">
                                        @if(is_null($tweet->User->UserProfile->icon_image))
                                            <img class="w-20 h-20 rounded-full border" src="{{asset('storage/images/no_image.png')}}" width="100" height="100">
                                        @else
                                            <img class="w-20 h-20 rounded-full border" src="{{asset($tweet->User->UserProfile->icon_image)}}" width="100" height="100">
                                        @endif
                                    </div>
                                    <div class="my-5 font-semibold">{{ $tweet->User->UserProfile->screen_name }}</div>
                                </div>
                                <div class="my-5 ml-5">{{ $tweet->content }}</div>
                                <div class="flex justify-around">
                                    @if(!is_null($tweet->image))
                                        <img class="w-50 h-50 rounded border" src="{{asset($tweet->image)}}" width="100" height="100">
                                    @endif
                                </div>
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
                            <div class="flex justify-end mx-5">{{ $tweet->updated_at }}</div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
