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
            @if($errors->any())
                <div class="mx-10">
                    <ul class="flex">
                        @foreach($errors->all() as $error)
                            <li class="text-red-700">{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <div class="w-11/12 max-w-screen-md m-auto my-5">
            <div class="max-w-screen-md m-auto bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                <div class="py-5">
                        <div class="flex focus:outline-none">
                            <div class="m-5">
                                    @if(is_null($user->userProfile->icon_image))
                                        <img class="w-20 h-20 rounded" src="{{asset('storage/images/no_image.png')}}" width="100" height="100">
                                    @else
                                        <img class="w-20 h-20 rounded" src="{{asset($user->userProfile->icon_image)}}" width="100" height="100">
                                    @endif
                            </div>
                            <div class="my-5 font-semibold">{{ $user->userProfile->screen_name }}</div>
                        </div>
                    <form method="POST" action="{{route('tweet.update',['id' => $tweet->id])}}" enctype="multipart/form-data">
                        @csrf
                        <div class="my-5 ml-5">
                            <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400"></label>
                            <input id="content" value="{{$tweet->content}}"  name="content" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></input>
                        </div>
                        <div class="flex justify-around">
                                @if(!is_null($tweet->image))
                                    <img class="w-50 h-50 rounded" src="{{asset($tweet->image)}}" width="100" height="100">
                                @endif
                        </div>
                        <div class="mb-8 ml-5">
                                <label for="tweetImage" class="text-sm block">画像を添付</label>
                                <input name="tweetImage" type="file" id="tweetImage" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" placeholder="アイコン画像">
                        </div>
                        <div class="mt-5 mx-5 text-s flex justify-end">{{ $tweet->updated_at }}</div>
                        <div class="flex justify-around">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit">ツイートを更新する</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>