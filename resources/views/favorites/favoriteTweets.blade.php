<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-around">
            <a href="{{route('dashboard')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight">タイムライン</h2></a>
            <a href="{{route('tweet.create')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight">ツイートする</h2></a>
            <a href="{{route('user.index')}}"><h2 class="mx-5 font-semibold text-xl text-gray-800 leading-tight">ユーザー一覧</h2></a>
            <a href="{{route('profile.index')}}"><h2 class="mx-5  text-xl text-gray-400 leading-tight">マイページ</h2></a>
        </div>    
    </x-slot>
    
    {{-- いいねしたツイートたち表示 --}}
    <div class="max-w-screen-md m-auto bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
        @foreach($favoriteTweets as $favoriteTweet)
            <div class="border py-5">
                <a href="{{route('profile.show',['id' => $favoriteTweet->tweet->user->userProfile->user_id])}}">
                    <div class="flex focus:outline-none">
                        <div class="m-5">
                            @if(is_null($favoriteTweet->Tweet->User->UserProfile->icon_image))
                                <img class="w-20 h-20 rounded-full border" src="{{asset('storage/images/no_image.png')}}">
                            @else
                                <img class="w-20 h-20 rounded-full border" src="{{asset($favoriteTweet->Tweet->User->UserProfile->icon_image)}}">
                            @endif
                        </div>
                        <div class="my-5 font-semibold">{{ $favoriteTweet->tweet->user->userProfile->screen_name }}</div>
                    </div>
                    <div class="my-5 ml-5">{{ $favoriteTweet->tweet->content }}</div>
                    <div class="flex justify-around">
                        @if(!is_null($favoriteTweet->tweet->image))
                        <img class="w-20 h-20 rounded" src="{{asset($favoriteTweet->tweet->image)}}">
                        @endif
                    </div>
                    <div class="flex justify-end mr-3 text-s">{{ $favoriteTweet->tweet->updated_at }}</div>
                </a>
            </div>
        @endforeach
    </div>
</x-app-layout>