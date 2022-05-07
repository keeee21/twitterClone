<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-around">
            <a href="{{route('dashboard')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight">タイムライン</h2></a>
            <a href="{{route('tweet.create')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight">ツイートする</h2></a>
            <a href="{{route('user.index')}}"><h2 class="mx-5 font-semibold text-xl text-gray-800 leading-tight">ユーザー一覧</h2></a>
            <a href="{{route('profile.index')}}"><h2 class="mx-5  text-xl text-gray-400 leading-tight">マイページ</h2></a>
        </div>    
    </x-slot>
    
    {{-- フォローした人たち表示 --}}
    <div flex justify-around items-center>
        <div class="w-11/12 max-w-screen-md m-auto">
            @foreach($followers as $follower)
                    <a href="{{route('profile.show',['id' => $follower->UserProfile->user_id])}}">
                        <div class="my-5 py-5 flex justify-around border focus:outline-none focus:border-b-2 focus:border-indigo-500">
                            <div class="my-2">
                                @if(is_null($follower->UserProfile->icon_image))
                                    <img class="w-20 h-20 rounded" src="{{asset('storage/images/no_image.png')}}" width="100" height="100">
                                @else
                                    <img class="w-20 h-20 rounded" src="{{asset($follower->UserProfile->icon_image)}}" width="100" height="100">
                                @endif
                            </div>
                            <div class="my-5">{{ $follower->UserProfile->screen_name }}</div>
                        </div>
                    </a>
            @endforeach
        </div>
    </div>
</x-app-layout>