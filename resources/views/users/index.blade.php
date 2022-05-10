<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-around">
            <a href="{{route('dashboard')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight">タイムライン</h2></a>
            <a href="{{route('tweet.create')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight">ツイートする</h2></a>
            <a href="{{route('user.index')}}"><h2 class="mx-5 font-semibold text-xl text-gray-800 leading-tight">ユーザー一覧</h2></a>
            <a href="{{route('profile.index')}}"><h2 class="mx-5  text-xl text-gray-400 leading-tight">マイページ</h2></a>
        </div>    
    </x-slot>
    
    <div class="max-w-screen-md m-auto mt-5 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
        @foreach($profiles as $profile)
            <div class="border py-5">
                <div class="flex justify-end mr-3">
                    @if(!$profile->User->canFollow($profile->User->id))
                    <button data-user-id="{{$profile->User->id}}" id="{{$profile->User->id}}" class="follow pushedUnFollow inline-flex items-center px-4 py-2 mb-5 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">フォロー</button>
                    @else
                    <button data-user-id="{{$profile->User->id}}" id="{{$profile->User->id}}" class="follow pushedFollow inline-flex items-center px-4 py-2 mb-5 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">フォロー解除</button>
                    @endif
                </div>
                <a href="{{route('profile.show',['id' => $profile->user_id])}}">
                    <div class="flex focus:outline-none">
                        <div class="m-5">
                            @if(is_null($profile->icon_image))
                            <img class="w-20 h-20 rounded-full border" src="{{asset('storage/images/no_image.png')}}">
                            @else
                            <img class="w-20 h-20 rounded-full border" src="{{asset($profile->icon_image)}}">
                            @endif
                        </div>
                        <div class="my-5 font-semibold">{{$profile->screen_name}}</div>
                    </div>
                    <div class="flex justify-around mx-5 mb-5">{{$profile->description}}</div>
                </a>
            </div>
        @endforeach
    </div>
</x-app-layout>