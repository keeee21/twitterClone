<x-app-layout>
    <x-slot name="header">
        <a href="{{route('dashboard')}}"><h2 class="font-semibold text-xl text-gray-800 leading-tight">今なにしてる？</h2></a>
    </x-slot>
    
    <div flex justify-around items-center>
        <div class="w-11/12 max-w-screen-md m-auto">

            {{-- フォーム作成 --}}
                <h1 class="text-xl font-bold mt-5">ツイート作成</h1>

                <div>
                    <form method="POST" action="{{route('tweet.store')}}">
                        @csrf
                        <div>
                            <textarea name="content" id="" cols="20" rows="10"></textarea>
                        </div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit" value="ツイートする">ツイートする</button>
                    </form>
                    <form class="mt-5" method="GET" action="{{route('dashboard')}}">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit" >戻る</button>
                    </form>

                </div>
            


        </div>
    </div>
</x-app-layout>
