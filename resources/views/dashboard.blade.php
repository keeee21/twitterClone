<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <a href="{{route('dashboard')}}"><h2 class="m-3 font-semibold text-xl text-gray-800 leading-tight">タイムライン</h2></a>
            <a href=""><h2 class="m-3 font-semibold text-xl text-gray-800 leading-tight">ユーザー一覧</h2></a>
        </div>    
    </x-slot>
    
    <div flex justify-around items-center>
        <div class="w-11/12 max-w-screen-md m-auto">

            <div class="bg-pink-500">
                <div class="flex">                   
                    <a href="{{route('tweet.create')}}" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">ツイートする</a>
                    <a href="{{route('profile.create')}}" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">プロフィール登録</a>
                </div>
            </div>

            <div>
            </div>

                <div class="">
                    <div class="m-auto flex justify-around">
                        <div scope="col">名前</div>
                        <div scope="col">ツイート内容</div>
                        <div scope="col">作成日</div>
                        <div scope="col">ツイートの詳細</div>

                    </div>
                    @foreach($tweets as $tweet)
                    <div class="m-auto flex justify-around">
                        <div><a href="{{ route('profile.show',['id' => $tweet->user_id]) }}">{{ $tweet->User->name}}</a></div>
                        <div>{{ $tweet->content }}</div>
                        <div>{{ $tweet->created_at }}</div>
                        <div><a href="{{route('tweet.show',['id' => $tweet->id])}}">詳細を見る</a>
                        </div>
                    </div>
                    @endforeach
                </div>
        </div>
    </div>
</x-app-layout>
