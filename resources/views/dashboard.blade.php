<x-app-layout>
    <x-slot name="header">
        <img src="../../storage/app/images/twitter_icon.jpeg" alt="">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('タイムライン') }}
        </h2>
    </x-slot>
    <div flex justify-around items-center>
        <div class="w-11/12 max-w-screen-md m-auto">

            {{-- タイトル --}}
            <h1 class="text-xl font-bold mt-5">ツイート作成</h1>

            {{-- 入力フォーム --}}
            <div class="bg-white rounded-md mt-5 p-3">
                <form action="/" method="POST">
                    @csrf
                    <div class="flex flex-col mt-2">
                            <p class="font-bold">本文</p>
                            <textarea class="border rounded px-2" name="message"></textarea>
                    </div>
                    <div class="flex justify-end mt-2">
                            <input class="my-2 px-2 py-1 rounded bg-blue-300 text-blue-900 font-bold link-hover cursor-pointer" type="submit" value="ツイート">
                    </div>
                </form>
            </div>

            <!-- タイムライン生成  -->
            {{-- @foreach ($ as $) --}}
                <div class="bg-white rounded-md mt-1 mb-5 p-3">
            {{-- 投稿/ツイート --}}
                <div>
                    {{-- <p class="mb-2 text-xs">{{->created_at}}</p> --}}
                    {{-- <p class="mb-2 text-l">{{->name}}</p> --}}
                    {{-- <p class="mb-2">{{->message}}</p> --}}
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
                                {{-- <p class="mt-2 text-xs">{{->created_at}}</p> --}}
                                {{-- <p class="my-2 text-sm">{{reply_message}}</p> --}}
                            </div>
                        </div>
                    </div>
            {{-- @endforeach --}}
        


        </div>
    </div>
</x-app-layout>
