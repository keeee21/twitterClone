<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">今なにしてる？</h2>
    </x-slot>
    
    <div flex justify-around items-center>
        <div class="w-11/12 max-w-screen-md m-auto">

            {{-- フォーム作成 --}}
            <div>
                <h1 class="text-xl font-bold mt-5">ツイート詳細</h1>

                {{$tweet->user_id}}
                {{$tweet->content}}
                {{$tweet->image}}
                {{$tweet->created_at}}

                @if (Auth::id() === $tweet->user_id)
                    <form method="get" action="get">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit" >削除する</button>
                    </form>
                @endif

            </div>


            


        </div>
    </div>
    
</x-app-layout>

{{--  //ツイートの詳細表示
// もしツイートしたアカウントがアクセスしたら、削除ボタンが表示される。
--}}
