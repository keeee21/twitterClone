<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">タイムライン</h2>
    </x-slot>
    
    <div flex justify-around items-center>
        <div class="w-11/12 max-w-screen-md m-auto">

            {{-- タイトル --}}
                <h1 class="text-xl font-bold mt-5">ツイート作成</h1>

            <!-- {{-- 入力フォーム --}}
            <div class="bg-white rounded-md mt-5 p-3">
                <form action="{{route('dashboard')}}" method="POST">
                    @csrf
                    <div class="flex flex-col mt-2">
                            <p class="font-bold">本文</p>
                            <textarea class="border rounded px-2" name="content"></textarea>
                    </div>
                    <div class="flex justify-end mt-2">
                            <input class="my-2 px-2 py-1 rounded bg-blue-300 text-blue-900 font-bold link-hover cursor-pointer" type="submit" value="ツイート">
                    </div>
                </form>
            </div> -->
            

            <!-- タイムライン生成 
            {{-- @foreach ($tweets as $tweet) --}}
                <div class="bg-white rounded-md mt-1 mb-5 p-3">
            {{-- 投稿/ツイート --}}
                <div>
                    {{-- <p class="mb-2 text-xs">{{$tweet->created_at}}</p> --}}
                    {{-- <p class="mb-2 text-l">{{$tweet->name}}</p> --}}
                    {{-- <p class="mb-2">{{$tweet->content}}</p> --}}
                </div>
            {{-- 詳細ボタン --}}
                <form class="flex justify-end mt-5" action="/" method="POST">
                    @csrf
                    <input class="border rounded px-2 flex-auto" type="text" name="reply_message">
                    <input class="px-2 py-1 ml-2 rounded bg-green-600 text-white font-bold link-hover cursor-pointer" type="submit" value="詳細を見る">
                </form>

                {{-- 返信 --}}
                <hr class="mt-2 m-auto">
                    <div class="flex justify-end">
                        <div class="w-11/12">
                            <div>
                                {{-- <p> class="mt-2 text-xs">{{$tweet->created_at}}</p> --}}
                            </div>
                        </div>
                    </div>
            {{-- @endforeach --}} -->


            {{-- ここからアレンジ　--}}
            <div class="bg-pink-500">
                <div class="flex">
                    <form action="{{route('tweet.create')}}" method="GET">
                        <button type="submit " class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'">ツイートする</button>
                    </form>

                    <form action="" method="">
                        <button type="submit " class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'">プロフィール更新</button>
                    </form>

                </div>

            </div>









        


        </div>
    </div>
</x-app-layout>
