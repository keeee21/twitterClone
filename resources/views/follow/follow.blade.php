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
    <div class="max-w-screen-md m-auto bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
        @foreach($follows as $follow)
            <div class="border py-5">
                <a href="{{route('profile.show',['id' => $follow->UserProfile->user_id])}}">
                    <div class="flex focus:outline-none">
                        <div class="m-5">
                            @if(is_null($follow->UserProfile->icon_image))
                                <img class="w-20 h-20 rounded-full border" src="{{asset('storage/images/no_image.png')}}" width="100" height="100">
                            @else
                                <img class="w-20 h-20 rounded-full border" src="{{asset($follow->UserProfile->icon_image)}}" width="100" height="100">
                            @endif
                        </div>
                        <div class="my-5">{{ $follow->UserProfile->screen_name }}</div>
                    </div>
                    <div class="mx-10">{{$follow->userProfile->description}}</div>
                </a>
            </div>
        @endforeach
    </div>
</x-app-layout>