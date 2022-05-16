<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-around">
            <a href="{{route('dashboard')}}"><h2 class="mx-5  text-xl text-gray-400 leading-tight">タイムライン</h2></a>
            <a href="{{route('tweet.create')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight">ツイートする</h2></a>
            <a href="{{route('user.index')}}"><h2 class="mx-5  text-xl text-gray-400 leading-tight">ユーザー一覧</h2></a>
            <a href="{{route('profile.index')}}"><h2 class="mx-5 font-semibold text-xl text-gray-800 leading-tight">マイページ</h2></a>
        </div>   
    </x-slot>
    
    <div class="w-11/12 max-w-screen-md m-auto">
        <div class="flex justify-around items-center my-5">
            @if($errors->any())
                <div>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="text-red-600">{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="mt-8">
            <form method="POST" action="{{route('profile.update',['id' => $user->id])}}" enctype="multipart/form-data" class="w-10/12 mx-auto md:max-w-md">
                @csrf
                <div class="mb-8">
                    <label for="screen_name" class="text-sm block">アカウント名</label>
                    <input name="screen_name" value="{{$user->UserProfile->screen_name}}" type="text" id="screen_name" required class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50" placeholder="アカウント太郎">
                </div>
                <div class="mb-8">
                    <label for="description" class="text-sm block">自己紹介</label>
                    <input name="description" value="{{$user->UserProfile->description}}" type="text" id="description" class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50" placeholder="自己紹介">
                </div>
                <div class="mb-8">
                    <label for="location" class="text-sm block">場所</label>
                    <input name="location" value="{{$user->UserProfile->location}}" type="text" id="location" class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50" placeholder="場所">
                </div>
                <div class="mb-8">
                    <label for="url" class="text-sm block">URL</label>
                    <input name="url" value="{{$user->UserProfile->url}}" type="text" id="text" class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50" placeholder="URL">
                </div>
                <div class="mb-8">
                    <label for="icon_image" class="text-sm block">アイコン</label>
                    <input name="icon_image" type="file" id="icon_image" class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50" placeholder="アイコン画像">
                </div>
                <div class="mb-8">
                    <label for="header_image">ヘッダー画像</label>
                    <input name="header_image" type="file" cols="30" rows="8" class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50" placeholder="ヘッダー画像"></input>
                </div>

                <div class="mb-8">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'">プロフィール更新</button>
                    <a href="{{route('dashboard')}}" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'" >タイムラインに戻る</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
