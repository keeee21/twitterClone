<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-around">
            <a href="{{route('dashboard')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight">タイムライン</h2></a>
            <a href="{{route('tweet.create')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight">ツイートする</h2></a>
            <a href="{{route('user.index')}}"><h2 class="mx-5 font-semibold text-xl text-gray-800 leading-tight">ユーザー一覧</h2></a>
            <a href="{{route('profile.index')}}"><h2 class="mx-5  text-xl text-gray-400 leading-tight">マイページ</h2></a>
        </div>    
    </x-slot>
    
    <div flex justify-around items-center>
        <div class="w-11/12 max-w-screen-md m-auto">
            @foreach($profiles as $profile)
            <a href="{{route('profile.show',['id' => $profile->user_id])}}">
            <div class="my-5 py-5 flex justify-around border focus:outline-none focus:border-b-2 focus:border-indigo-500">
                <div class="my-5">
                    @if(is_null($profile->icon_image))
                        <img class="w-20 h-20 rounded-full" src="{{asset('storage/images/no_image.png')}}" width="100" height="100">
                    @else
                        <img class="w-20 h-20 rounded-full" src="{{asset($profile->icon_image)}}" width="100" height="100">
                    @endif
                </div>
                <div class="my-5">{{$profile->screen_name}}</div>
                <div class="my-5">{{$profile->description}}</div>
                
                
                @if(!$profile->User->canFollow($profile->User->id))
                    <form method="POST" action="{{route('follow',['user'=>$profile->User->id])}}">
                    @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">フォロー</button>
                    </form>
                @else
                    <form method="POST" action="{{route('unfollow',['user'=>$profile->User->id])}}">
                    @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">フォロー解除</button>
                    </form>
                @endif
            </div>
            </a>
            @endforeach
        </div>
    </div>
</x-app-layout>