<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-around">
            <a href="{{route('dashboard')}}"><h2 class="mx-5  text-xl text-gray-400 leading-tight">タイムライン</h2></a>
            <a href="{{route('tweet.create')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight">ツイートする</h2></a>
            <a href="{{route('user.index')}}"><h2 class="mx-5 font-semibold text-xl text-gray-800 leading-tight">ユーザー一覧</h2></a>
            <a href="{{route('profile.index')}}"><h2 class="mx-5  text-xl text-gray-400 leading-tight">マイページ</h2></a>
        </div> 
    </x-slot>
    
    <div flex justify-around items-center>
        <div class="w-11/12 max-w-screen-md m-auto">

            <div class="my-5">
                @if(is_null($user->UserProfile->header_image))
                    <img class="w-15 h-15 rounded" src="{{asset('storage/images/no_image.png')}}" width="100" height="100">
                @else
                    <img class="w-15 h-15 rounded" src="{{asset($user->UserProfile->header_image)}}" width="100" height="100">
                @endif
            </div>

            <div class="max-w-screen-md m-auto bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                <div class="flex">
                    <div class="m-5">
                        @if(empty($user->UserProfile->icon_image))
                            <img class="w-20 h-20 rounded-full" src="{{asset('storage/images/no_image.png')}}" width="100" height="100">
                        @else
                            <img class="w-20 h-20 rounded-full" src="{{asset($user->UserProfile->icon_image)}}" width="100" height="100">
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
                        <div>
                            <a href="">フォロー数:{{$user->followCount()}}</a>
                            <a href="">フォロワー数:{{$user->followerCount()}}</a>
                        </div>

                        @if (Auth::id() === $user->UserProfile->user_id)
                            <a href="{{route('profile.edit')}}" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">変更する</a>
                        @endif
                    </div>
                    <div class="flex justify-end">
                        @if(!$user->canFollow($user->id))
                            <form method="POST" action="{{route('follow',['user'=>$user->id])}}">
                            @csrf
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">フォロー</button>
                            </form>
                            @else
                            <form method="POST" action="{{route('unfollow',['user'=>$user->id])}}">
                            @csrf
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">フォロー解除</button>
                            </form>
                        @endif
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
                                    <img class="w-20 h-20 rounded-full" src="{{asset('storage/images/no_image.png')}}" width="100" height="100">
                                @else
                                    <img class="w-20 h-20 rounded-full" src="{{asset($user->UserProfile->icon_image)}}" width="100" height="100">
                                @endif
                            </div>
                            <div class="my-5 font-semibold">{{ $tweet->content }}</div>
                            <div class="m-5 text-s">{{ $tweet->created_at }}</div>
                        </div>
                        <div class=" flex justify-around">
                            @if(!is_null($tweet->image))
                                <img class="w-full h-50 rounded" src="{{asset($tweet->image)}}" width="100" height="100">
                            @endif
                        </div>
                        <div>
                            @if(!$user->canFavorite($tweet->id))                                        
                                <form method="POST" class="ml-5" action="{{route('favorite',$tweet)}}">
                                @csrf
                                    <button type="submit" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">いいね</button>
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
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
