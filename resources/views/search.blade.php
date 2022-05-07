<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-around">
            <a href="{{route('dashboard')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight">タイムライン</h2></a>
            <a href="{{route('tweet.create')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight">ツイートする</h2></a>
            <a href="{{route('user.index')}}"><h2 class="mx-5 font-semibold text-xl text-gray-800 leading-tight">ユーザー一覧</h2></a>
            <a href="{{route('profile.index')}}"><h2 class="mx-5  text-xl text-gray-400 leading-tight">マイページ</h2></a>
        </div>     
    </x-slot>
    {{-- tweet.showを参照 --}}

    <div class="flex justify-around items-center">
      <div class="w-11/12 max-w-screen-md m-auto my-5">

        {{-- 検索結果の表示 --}} 
          {{-- アカウント表示 --}}
            <div class="max-w-screen-md m-auto bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
              @if(!is_null($searchedAccounts))
                @foreach($searchedAccounts as $searchedAccount)
                  <div class="border py-5">
                    <a href="{{route('profile.show',['id' => $searchedAccount->user_id])}}">
                      <div class="flex justify-around focus:outline-none">
                        <div class="m-5">
                            @if(is_null($searchedAccount->icon_image))
                              <img class="w-20 h-20 rounded-full" src="{{asset('storage/images/no_image.png')}}" width="100" height="100">
                            @else
                              <img class="w-20 h-20 rounded-full" src="{{asset($searchedAccount->icon_image)}}" width="100" height="100">
                            @endif
                        </div>
                        <div class="my-5">{{$searchedAccount->screen_name}}</div>
                          @if(!$searchedAccount->User->canFollow($searchedAccount->User->id))
                              <form method="POST" action="{{route('follow',['user'=>$searchedAccount->User->id])}}">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-4 py-2 my-5 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">フォロー</button>
                            </form>
                          @else
                            <form method="POST" action="{{route('unfollow',['user'=>$searchedAccount->User->id])}}">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-4 py-2 my-5 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">フォロー解除</button>
                            </form>
                          @endif
                        </div>
                      <div class="flex justify-around">{{$searchedAccount->description}}</div>
                    </a>
                  </div>
                @endforeach
              @endif
            </div>
              {{-- ツイート表示 --}}

              <div class="max-w-screen-md m-auto bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                @if(!is_null($searchedTweets))
                  @foreach($searchedTweets as $searchedTweet)
                    <div class="border py-5">
                      <a href="{{route('tweet.show',['id' => $searchedTweet->id])}}">
                        <div class="flex justify-around focus:outline-none">
                          <div class="m-5">
                            @if(is_null($searchedTweet->User->UserProfile->icon_image))
                              <img class="w-20 h-20 rounded-full" src="{{asset('storage/images/no_image.png')}}" width="100" height="100">
                            @else
                              <img class="w-20 h-20 rounded-full" src="{{asset($searchedTweet->User->UserProfile->icon_image)}}" width="100" height="100">
                            @endif
                          </div>
                          <div class="my-5">{{$searchedTweet->User->UserProfile->screen_name}}</div>
                        </div>
                        <div class="flex justify-around">{{$searchedTweet->content}}</div>
                        <div>
                          @if(!$searchedTweet->user->canFavorite($searchedTweet->id))
                              <form method="POST" class="ml-5" action="{{route('favorite',$searchedTweet->id)}}">
                                @csrf
                                <button type="submit" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">いいね</button>
                              </form>
                          @else
                              <form method="POST" class="ml-5" action="{{route('unfavorite',$searchedTweet->id)}}">
                                @csrf
                                <button type="submit" class="bg-red-700 text-white hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">いいね</button>
                              </form>
                          @endif
                        </div>
                      </a>
                    </div>
                  @endforeach
                @endif
              </div>
        </div>
    </div>
</x-app-layout>