<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-around">
            <a href="{{route('dashboard')}}"><h2 class="mx-5 font-semibold text-xl text-gray-800 leading-tight">タイムライン</h2></a>
            <a href="{{route('tweet.create')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight">ツイートする</h2></a>
            <a href="{{route('user.index')}}"><h2 class="mx-5  text-xl text-gray-400 leading-tight">ユーザー一覧</h2></a>
            <a href="{{route('profile.index')}}"><h2 class="mx-5  text-xl text-gray-400 leading-tight">マイページ</h2></a>
        </div>    
    </x-slot>

    <div flex justify-around items-center>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="max-w-screen-md m-auto bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            @foreach($tweets as $tweet)
                @if($user->canFollow($tweet->user_id) || $tweet->user_id == Auth::id())
                <div class="border py-5">
                    <a href="{{route('tweet.show',['id' => $tweet->id])}}">
                        <div class="flex focus:outline-none">
                            <div class="m-5">
                                @if(is_null($tweet->User->UserProfile->icon_image))
                                    <img class="w-20 h-20 rounded" src="{{asset('storage/images/no_image.png')}}" width="100" height="100">
                                @else
                                    <img class="w-20 h-20 rounded" src="{{asset($tweet->User->UserProfile->icon_image)}}" width="100" height="100">
                                @endif
                            </div>
                            <div class="my-5 font-semibold">{{ $tweet->User->UserProfile->screen_name }}</div>
                            <div class="m-5 text-s">{{ $tweet->created_at }}</div>
                        </div>
                        <div class="my-5 ml-5">{{ $tweet->content }}</div>
                        <div class="flex justify-around">
                                @if(!is_null($tweet->image))
                                    <img class="w-50 h-50 rounded" src="{{asset($tweet->image)}}" width="100" height="100">
                                @endif
                        </div>
                        <div>
                        @if(!$user->canFavorite($tweet->id))
                            <form method="POST" class="ml-5" action="{{route('favorite',$tweet)}}">
                            @csrf
                                <button type="submit" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">いいね</button>
                            </form>
                            @else
                            <form method="POST" class="ml-5" action="{{route('unfavorite',$tweet)}}">
                            @csrf
                                <button type="submit" class="bg-red-700 text-white hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">いいね</button>
                            </form>
                        @endif
                        </div>
                    </a>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>
