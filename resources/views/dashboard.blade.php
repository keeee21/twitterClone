<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-around">
            <a href="{{route('dashboard')}}"><h2 class="mx-5 font-semibold text-xl text-gray-800 leading-tight">タイムライン</h2></a>
            <a href="{{route('tweet.create')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight">ツイートする</h2></a>
            <a href="{{route('user.index')}}"><h2 class="mx-5  text-xl text-gray-400 leading-tight">ユーザー一覧</h2></a>
            <a href="{{route('profile.index')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight">マイページ</h2></a>
        </div>    
    </x-slot>

    {{-- フォーム作成 --}}
    <div class="max-w-screen-md m-auto rounded-lg">
        <form method="GET" action="{{route('search.show')}}">
            <div class="flex justify-end mt-4">
                <select name="category" class="mb-2 mx-2">
                    <option value="all">全て</option>
                    <option value="tweet">ツイート</option>
                    <option value="account">アカウント</option>
                </select>
                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center mb-2 px-4 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit" value="色々と検索する">キーワード検索</button>
                </div>
            </div>
            <div>
                <input type="keyword" name="keyword" required class="block p-2.5 w-full text-sm text-gray-900 bg-white-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="キーワードを入力してください">
            </div>
        </form>
    </div>

    <div class="flex justify-around items-center my-5" >
        @if($errors->any())
            <div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li class="text-red-600">{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('error'))
            <div>
                <p class="text-red-600">{{session('error')}}</p>
            </div>
        @endif
        @if(session('success'))
            <div>
                <p class="text-green-600">{{session('success')}}</p>
            </div>
        @endif
    </div>

    <div class="max-w-screen-md m-auto mt-5 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            @foreach($tweets as $tweet)
                @if($user->canFollow($tweet->user_id) || $tweet->user_id == Auth::id())
                <div class="border py-5">
                    <a href="{{route('tweet.show',['id' => $tweet->id])}}">
                        <div class="flex focus:outline-none">
                            <div class="m-5">
                                @if(is_null($tweet->User->UserProfile->icon_image))
                                    <img class="w-20 h-20 rounded-full border" src="{{asset('images/no_image.png')}}" >
                                @else
                                    <img class="w-20 h-20 rounded-full border" src="{{asset($tweet->User->UserProfile->icon_image)}}">
                                @endif
                            </div>
                            <div class="my-5 font-semibold">{{ $tweet->User->UserProfile->screen_name }}</div>
                        </div>
                        <div class="my-5 ml-5">{{ $tweet->content }}</div>
                        <div class="flex justify-around">
                                @if(!is_null($tweet->image))
                                    <img class="w-20 h-20 rounded" src="{{asset($tweet->image)}}">
                                @endif
                        </div>
                    </a>
                    <div class="flex justify-content">
                        <div>
                            @if(!$user->canFavorite($tweet->id))
                                <button data-tweet-id="{{$tweet->id}}" id="{{$tweet->id}}" class="favorite btn">いいね</button>
                            @else
                                <button data-tweet-id="{{$tweet->id}}" id="{{$tweet->id}}" class="favorite pushedFavorite">いいね</button>
                            @endif
                        </div>
                        <div class="mt-2">
                            <a href="{{route('tweet.show',['id' => $tweet->id])}}" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-900">リプする</a>
                        </div>
                    </div>
                    <div class="mt-2 mx-5 text-s flex justify-end">{{ $tweet->updated_at }}</div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>

