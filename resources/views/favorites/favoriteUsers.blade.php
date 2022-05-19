<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-around">
            <a href="{{route('dashboard')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight hover:text-blue-700">タイムライン</h2></a>
            <a href="{{route('tweet.create')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight hover:text-blue-700">ツイートする</h2></a>
            <a href="{{route('user.index')}}"><h2 class="mx-5 font-semibold text-xl text-gray-800 leading-tight hover:text-blue-700">ユーザー一覧</h2></a>
            <a href="{{route('profile.index')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight hover:text-blue-700">マイページ</h2></a>
        </div>    
    </x-slot>
    
    {{-- ツイートにいいねを押した人たちを表示 --}}
    <div class="max-w-screen-md m-auto mt-5 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
        @foreach($favoriteUsers as $favoriteUser)
            <div class="border py-5">
                <div class="flex justify-end mr-3">
                    @if($favoriteUser->user_id !== Auth::id())
                        @if(!$favoriteUser->User->canFollow($favoriteUser->User->id))
                        <button data-user-id="{{$favoriteUser->User->id}}" id="{{$favoriteUser->User->id}}" class="follow pushedUnFollow inline-flex items-center px-4 py-2 mb-5 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">フォロー</button>
                        @else
                        <button data-user-id="{{$favoriteUser->User->id}}" id="{{$favoriteUser->User->id}}" class="follow pushedFollow inline-flex items-center px-4 py-2 mb-5 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">フォロー解除</button>
                        @endif
                    @endif
                </div>
                <a href="{{route('profile.show',['id' => $favoriteUser->User->UserProfile->user_id])}}">
                    <div class="flex focus:outline-none">
                        <div class="m-5">
                            @if(is_null($favoriteUser->User->UserProfile->icon_image))
                                <img class="w-20 h-20 rounded-full border" src="{{asset('images/no_image.png')}}">
                            @else
                                <img class="w-20 h-20 rounded-full border" src="{{asset($favoriteUser->User->UserProfile->icon_image)}}">
                            @endif
                        </div>
                        <div class="my-5 font-semibold">{{ $favoriteUser->User->UserProfile->screen_name }}</div>
                    </div>
                    <div class="flex justify-around mx-5 mb-5">{{ $favoriteUser->User->UserProfile->description }}</div>
                </a>
            </div>
        @endforeach
    </div>
</x-app-layout>