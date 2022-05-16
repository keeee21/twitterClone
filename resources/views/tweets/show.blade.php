<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-around">
            <a href="{{route('dashboard')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight">タイムライン</h2></a>
            <a href="{{route('tweet.create')}}"><h2 class="mx-5 font-semibold text-xl text-gray-800 leading-tight">ツイートする</h2></a>
            <a href="{{route('user.index')}}"><h2 class="mx-5  text-xl text-gray-400 leading-tight">ユーザー一覧</h2></a>
            <a href="{{route('profile.index')}}"><h2 class="mx-5  text-xl text-gray-400 leading-tight">マイページ</h2></a>
        </div>     
    </x-slot>
    
    <div class="flex justify-around items-center my-5">
        @if($errors->any())
            <div class="mx-10">
                <ul class="flex">
                    @foreach($errors->all() as $error)
                        <li class="text-red-700">{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('success'))
            <div>
                <p class="text-red-600">{{session('success')}}</p>
            </div>
        @endif
        @if(session('error'))
            <div>
                <p class="text-red-600">{{session('error')}}</p>
            </div>
        @endif
    </div>
        
    <div class="w-11/12 max-w-screen-md m-auto my-5">
        <div class="max-w-screen-md m-auto bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div>    
                <div class="flex justify-end mt-3 mb-0 p-0">
                    @if (Auth::id() === $tweet->user->id)
                        <form method="post" action="{{route('tweet.destroy',$tweet->id)}}" class="mx-5">
                        @csrf
                            <a href="{{route('tweet.edit',$tweet->id)}}" class="mx-10 font-semibold hover:text-green-700">編集する</a>
                            <button value="削除" data-id="{{$tweet->id}}" onclick="deletePost();" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit" >削除する</button>
                        </form>
                    @endif
                </div>
                <div class="py-5">
                    <div class="flex focus:outline-none">
                        <div class="m-5">
                                @if(is_null($tweet->user->userProfile->icon_image))
                                    <img class="w-20 h-20 rounded" src="{{asset('images/no_image.png')}}">
                                @else
                                    <img class="w-20 h-20 rounded" src="{{asset($tweet->user->userProfile->icon_image)}}">
                                @endif
                        </div>
                        <div class="my-5 font-semibold">{{ $tweet->user->userProfile->screen_name }}</div>
                    </div>
                    <div class="my-5 ml-5">{{ $tweet->content }}</div>
                    <div class="flex justify-around">
                            @if(!is_null($tweet->image))
                                <img class="w-20 h-20 rounded" src="{{asset($tweet->image)}}">
                            @endif
                    </div>
                    <div>
                        @if(!$tweet->user->canFavorite($tweet->id))
                            <button data-tweet-id="{{$tweet->id}}" id="{{$tweet->id}}" class="favorite btn">いいね</button>
                        @else
                            <button data-tweet-id="{{$tweet->id}}" id="{{$tweet->id}}" class="favorite pushedFavorite">いいね</button>
                        @endif
                    </div>
                    <div class="mt-5 mx-5 text-s flex justify-end">{{ $tweet->updated_at }}</div>
                </div>
            </div>    
        </div>
            <div>
                <a href="{{route('favorite.users',['id'=>$tweet->id])}}" class="hover:text-blue-700">{{$numOfPushedFavoriteBtn}}件のいいね</a>
            </div>

        {{-- リプのフォーム表示 --}}
        <div class="my-5">
            <form method="POST" action="{{route('reply',$tweet)}}" enctype="multipart/form-data">
                @csrf
                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit" value="ツイートする">リプを送る</button>
                </div>
                <div>
                    <div>
                        <label for="reply" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400"></label>
                        <textarea id="reply" name="reply" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-white-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="リプを送ろう"></textarea>
                    </div>
                </div>
            </form>
        </div>

        {{-- リプの表示 --}}
        <div class="max-w-screen-md m-auto bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            @foreach($comments as $comment)
                <div class="border">
                    <div class="flex justify-end mx-5">
                        @if (Auth::id() === $comment->users->id)
                            <form method="post" action="{{route('reply.destroy',['id' => $comment->id])}}" class="mt-5">
                            @csrf
                                <button value="削除" data-id="{{$comment->id}}" onclick="deletePost();" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit" >削除する</button>
                            </form>
                        @endif
                    </div>
                    <div class="flex focus:outline-none">
                        <div class="m-5">
                                @if(is_null($comment->users->userProfile->icon_image))
                                    <img class="w-20 h-20 rounded border" src="{{asset('images/no_image.png')}}">
                                @else
                                    <img class="w-20 h-20 rounded border" src="{{asset($comment->users->userProfile->icon_image)}}">
                                @endif
                        </div>
                        <div class="my-5 font-semibold">{{ $comment->users->userProfile->screen_name }}</div>
                    </div>
                    <div class="my-5 ml-5">{{ $comment->reply }}</div>
                </div>
            @endforeach
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