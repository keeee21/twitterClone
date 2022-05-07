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
                        <button value="削除" data-id="{{$tweet->id}}" onclick="deletePost();" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit" >削除する</button>
                    </form>
                    @endif
                </div>
                <div>
                    <a href="{{route('favorite.users',['id'=>$tweet->id])}}">{{$pushedFavoriteBtnCount}}件のいいね</a>
                </div>

            {{-- フォーム作成 --}}
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
                        <!-- <div class="mb-8">
                            <label for="tweetImage" class="text-sm block">画像を添付</label>
                            <input name="tweetImage" type="file" id="tweetImage" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" placeholder="アイコン画像">
                        </div>  -->
                    </div>
                </form>
            </div>

            {{-- リプの表示 --}}
            <div class="max-w-screen-md m-auto bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                @foreach($comments as $comment)
                    <div class="border py-5">
                        <div class="flex focus:outline-none">
                            <div class="m-5">
                                    @if(is_null($comment->users->userProfile->icon_image))
                                        <img class="w-20 h-20 rounded" src="{{asset('storage/images/no_image.png')}}" width="100" height="100">
                                    @else
                                        <img class="w-20 h-20 rounded" src="{{asset($comment->users->userProfile->icon_image)}}" width="100" height="100">
                                    @endif
                            </div>
                        <div class="my-5 font-semibold">{{ $comment->users->userProfile->screen_name }}</div>
                        </div>
                            <div class="my-5 ml-5">{{ $comment->reply }}</div>
                    {{--<div>
                            @if(!$user->canFavorite($tweet->id))
                                <form method="POST" class="ml-5" action="{{route('favorite',$tweet)}}">
                                @csrf
                                    <button type="submit" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">いいね</button>
                                </form>
                                @else
                                <form method="POST" class="ml-5" action="{{route('unfavorite',$tweet)}}">
                                @csrf
                                    <button type="submit" class="bg-red-700 text-white hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">いいね</button>
                                </form>
                            @endif
                        </div>--}}
                        @if (Auth::id() === $comment->users->id)
                            <form method="post" action="{{route('tweet.destroy',$tweet->id)}}" class="mt-5">
                            @csrf
                                <button value="削除" data-id="{{$tweet->id}}" onclick="deletePost();" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit" >削除する</button>
                            </form>
                        @endif
                    </div>
                @endforeach
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