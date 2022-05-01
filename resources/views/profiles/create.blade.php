<!-- <x-app-layout>
    <x-slot name="header">
        <a href="#"><h2 class="font-semibold text-xl text-gray-800 leading-tight">プロフィール登録</h2></a>
    </x-slot>
    
    <div flex justify-around items-center>
        <div class="w-11/12 max-w-screen-md m-auto">

            <div>
                <div class="mt-8">createだよ
                    <form method="POST" action="{{route('profile.store')}}" class="w-10/12 mx-auto md:max-w-md" enctype="multipart/form-data">
                    @csrf
                        <div class="mb-8">
                            <label for="screen_name" class="text-sm block">アカウント名</label>
                            <input name="screen_name" value="" type="text" id="screen_name" class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50" required placeholder="Twitter上で使われる表示名です">
                        </div>
                        <div class="mb-8">
                            <label for="description" class="text-sm block">自己紹介</label>
                            <input name="description" value="" type="text" id="description" class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50" placeholder="自己紹介">
                        </div>
                        <div class="mb-8">
                            <label for="location" class="text-sm block">場所</label>
                            <input name="location" value="" type="text" id="location" class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50" placeholder="場所">
                        </div>
                        <div class="mb-8">
                            <label for="url" class="text-sm block">URL</label>
                            <input name="url" value="" type="url" id="url" class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50" placeholder="URL">
                        </div>
                        <div class="mb-8">
                            <label for="icon_image" class="text-sm block">アイコン</label>
                            <input name="icon_image" type="file" id="icon_image" class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50" placeholder="アイコン画像">
                        </div>
                        <div class="mb-8">
                            <label for="header_image">ヘッダー画像</label>
                            <input name="header_image" type="file" id="header_image" accept="image/png,image/jpeg,image/jpg" cols="30" rows="8" class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50" placeholder="ヘッダー画像"></input>
                        </div>
                        <div class="mb-8">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'">プロフィール登録</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> -->
