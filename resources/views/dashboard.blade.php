<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">タイムライン</h2>
    </x-slot>
    
    <div flex justify-around items-center>
        <div class="w-11/12 max-w-screen-md m-auto">

            <div class="bg-pink-500">
                <div class="flex">
                    <form action="{{route('tweet.create')}}" method="GET">
                        <button type="submit " class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'">ツイートする</button>
                    </form>

                    <form action="{{route('profile.create')}}" method="GET">
                        <button type="submit " class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'">プロフィール更新</button>
                    </form>
                </div>
            </div>

            <div>
            </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">名前</th>
                            <th scope="col">ツイート内容</th>
                            <th scope="col">作成日</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                    @foreach($tweets as $tweet)
                        <tr>
                        <th>{{ $tweet->User->name}}</th>
                        <th>{{ $tweet->content}}</th>
                        <th>{{ $tweet->created_at}}</th>
                        @endforeach
                        </tr>
                    </tbody>
                </table>
        </div>
    </div>
</x-app-layout>
