<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">タイムライン</h2>
    </x-slot>
    
    <div flex justify-around items-center>
        <div class="w-11/12 max-w-screen-md m-auto">

            <div class="bg-pink-300">
                <div class="flex">
                    <h1>プロフィール</h1>
                </div>
            </div>

            <div>
                <div class="mt-8">
                    <form method="GET" action="" class="w-10/12 mx-auto md:max-w-md">
                    @csrf
                        <div class="mb-8">
                            <label for="name" class="text-sm block">アカウント名</label>
                            <input type="text" id="name" class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50" placeholder="アカウント太郎">
                        </div>
                        <div class="mb-8">
                            <label for="description" class="text-sm block">自己紹介</label>
                            <input type="text" id="description" class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50" placeholder="自己紹介">
                        </div>
                        <div class="mb-8">
                            <label for="location" class="text-sm block">場所</label>
                            <input type="text" id="location" class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50" placeholder="場所">
                        </div>
                        <div class="mb-8">
                            <label for="url" class="text-sm block">URL</label>
                            <input type="text" id="url" class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50" placeholder="URL">
                        </div>
                        <div class="mb-8">
                            <label for="phone_number" class="text-sm block">電話番号</label>
                            <input type="tel" id="phone_number" class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50" placeholder="電話番号">
                        </div>
                        <div class="mb-8">
                            <label for="other">その他</label>
                            <textarea  id="other" cols="30" rows="8" class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50" placeholder="その他"></textarea>
                        </div>
                        <div class="flex justify-around">
                            <form class="" method="GET" action="">
                                <button type="submit " class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'">タイムラインに戻る</button>
                            </form>
                            <form class="" method="GET" action="{{route('profile.store')}}">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'">プロフィール更新</button>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
