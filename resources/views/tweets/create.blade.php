<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-around">
            <a href="{{route('dashboard')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight">タイムライン</h2></a>
            <a href="{{route('tweet.create')}}"><h2 class="mx-5 font-semibold text-xl text-gray-800 leading-tight">ツイートする</h2></a>
            <a href="{{route('user.index')}}"><h2 class="mx-5  text-xl text-gray-400 leading-tight">ユーザー一覧</h2></a>
            <a href="{{route('profile.index')}}"><h2 class="mx-5  text-xl text-gray-400 leading-tight">マイページ</h2></a>
        </div> 
    </x-slot>
    
    <div class="w-11/12 max-w-screen-md m-auto">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="my-5">
                    @foreach($errors->all() as $error)
                        <li class="text-red-700">{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- フォーム作成 --}}
        <div class="mt-5">
            <form method="POST" action="{{route('tweet.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit" value="ツイートする">ツイートする</button>
                </div>
                <div>
                    <div>
                        <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400"></label>
                        <textarea id="content" name="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="今なにしてる？"></textarea>
                    </div>
                    <div class="mb-8">
                        <label for="tweetImage" class="text-sm block">画像を添付</label>
                        <input name="tweetImage" type="file" id="tweetImage" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" placeholder="アイコン画像">
                    </div> 
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
