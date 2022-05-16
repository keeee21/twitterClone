<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-around">
            <a href="{{route('dashboard')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight">タイムライン</h2></a>
            <a href="{{route('tweet.create')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight">ツイートする</h2></a>
            <a href="{{route('user.index')}}"><h2 class="mx-5 font-semibold text-xl text-gray-800 leading-tight">ユーザー一覧</h2></a>
            <a href="{{route('profile.index')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight">マイページ</h2></a>
        </div>    
    </x-slot>
    
    {{-- ツイートにいいねを押した人たちを表示 --}}
    <div class="max-w-screen-md m-auto mt-5 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
        @foreach($favoriteUsers as $favoriteUser)
            <div class="border py-5">
                <a href="{{route('profile.show',['id' => $favoriteUser->User->UserProfile->user_id])}}">
                    <div class="flex focus:outline-none">
                        <div class="m-2">
                            @if(is_null($favoriteUser->User->UserProfile->icon_image))
                                <img class="w-20 h-20 rounded-full border" src="{{asset('images/no_image.png')}}">
                            @else
                                <img class="w-20 h-20 rounded-full border" src="{{asset($favoriteUser->User->UserProfile->icon_image)}}">
                            @endif
                        </div>
                        <div class="my-5 font-semibold">{{ $favoriteUser->User->UserProfile->screen_name }}</div>
                    </div>
                    <div class="my-5">{{ $favoriteUser->User->UserProfile->description }}</div>
                </a>
            </div>
        @endforeach
    </div>
</x-app-layout>