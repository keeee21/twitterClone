<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-around">
            <a href="{{route('dashboard')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight">タイムライン</h2></a>
            <a href="{{route('tweet.create')}}"><h2 class="mx-5 font-semibold text-xl text-gray-800 leading-tight">ツイートする</h2></a>
            <a href="{{route('user.index')}}"><h2 class="mx-5  text-xl text-gray-400 leading-tight">ユーザー一覧</h2></a>
            <a href="{{route('profile.index')}}"><h2 class="mx-5  text-xl text-gray-400 leading-tight">マイページ</h2></a>
        </div>     
    </x-slot>
    
    <div flex justify-around items-center>
        <div class="w-11/12 max-w-screen-md m-auto">
            <div>
                <h1 class="text-xl font-bold mt-5">{{$tweet->User->UserProfile->screen_name}}</h1>

                <div class="my-5 py-5 flex justify-around border focus:outline-none focus:border-b-2 focus:border-indigo-500">
                    <div class="my-2">
                        @if(is_null($tweet->User->UserProfile->icon_image))
                            <img class="w-20 h-20 rounded" src="{{asset('storage/images/no_image.png')}}" width="100" height="100">
                        @else
                            <img class="w-20 h-20 rounded" src="{{asset($tweet->User->UserProfile->icon_image)}}" width="100" height="100">
                        @endif
                    </div>
                    <div class="my-5">{{ $tweet->User->UserProfile->screen_name }}</div>
                    <div class="my-5">{{ $tweet->content }}</div>
                    <div class="my-2">
                        @if(!is_null($tweet->image))
                            <img src="{{asset($tweet->image)}}" width="50" height="50">
                        @endif
                    </div>
                    <div class="my-5">{{ $tweet->created_at }}</div>
                    @if (Auth::id() === $tweet->user_id)
                    <form method="post" action="{{route('tweet.destroy',$tweet->id)}}" class="mt-5">
                        @csrf
                        <button value="削除" data-id="{{$tweet->id}}" onclick="deletePost(this);" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit" >削除する</button>
                    </form>
                    @endif
                </div>
                <div>
                    @if(!$tweet->user->canFavorite($tweet->id))
                        <form method="POST" action="{{route('favorite',$tweet)}}">
                        @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">いいね</button>
                        </form>
                        @else
                        <form method="POST" action="{{route('unfavorite',$tweet)}}">
                        @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">いいねした</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function deletePost(e){
        if(confirm('本当に削除しても良いですか')){
            document.getElementById('delete'+e.dataset.id).submit();
        }
    }
</script>