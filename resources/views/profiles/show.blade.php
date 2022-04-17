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
                <h1 class="text-xl font-bold mt-5">プロフィール詳細</h1>

                    showです。

                    {{$profile->screen_name}}
                    {{$profile->description}}
                    {{$profile->location}}
                    {{$profile->url}}
                    {{$profile->icon_image}}
                    {{$profile->header_image}}
                    {{$profile->created_at}}
                    {{$profile->updated_at}}



                    <form method="GET" action="" class="w-10/12 mx-auto md:max-w-md">
                    @csrf
                        <div class="mb-8">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">フォロー</button>
                        </div>
                        
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

{{-- アカウント情報が表示される

ヘッダーに、登録した、画像が表示
アイコンの部分に登録した画像が表示される --}}
