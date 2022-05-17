<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-around">
            <a href="{{route('dashboard')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight hover:text-blue-700">タイムライン</h2></a>
            <a href="{{route('tweet.create')}}"><h2 class="mx-5 text-xl text-gray-400 leading-tight hover:text-blue-700">ツイートする</h2></a>
            <a href="{{route('user.index')}}"><h2 class="mx-5 font-semibold text-xl text-gray-800 leading-tight hover:text-blue-700">ユーザー一覧</h2></a>
            <a href="{{route('profile.index')}}"><h2 class="mx-5  text-xl text-gray-400 leading-tight hover:text-blue-700">マイページ</h2></a>
        </div>     
    </x-slot>

      {{-- アカウント表示 --}}

    <div class="w-11/12 max-w-screen-md m-auto my-5">
      <h1 class="my-3 text-xl font-semibold">検索結果</h1>
      @if(!is_null($searchedAccounts))
        <div class="max-w-screen-md m-auto bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
          <h2 class="bg-gray-300">アカウント</h2>
            @foreach($searchedAccounts as $searchedAccount)
              <div class="border py-5">
                <div class="flex justify-end mr-3">
                  @if(!$searchedAccount->User->canFollow($searchedAccount->User->id))
                    <button data-user-id="{{$searchedAccount->User->id}}" id="{{$searchedAccount->User->id}}" class="follow pushedUnFollow inline-flex items-center px-4 py-2 mb-5 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">フォロー</button>
                  @else
                    <button data-user-id="{{$searchedAccount->User->id}}" id="{{$searchedAccount->User->id}}" class="follow pushedFollow inline-flex items-center px-4 py-2 mb-5 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">フォロー解除</button>
                  @endif
                </div>
                <a href="{{route('profile.show',['id' => $searchedAccount->user_id])}}">
                  <div class="flex focus:outline-none">
                    <div class="m-5">
                        @if(is_null($searchedAccount->icon_image))
                          <img class="w-20 h-20 rounded-full border" src="{{asset('images/no_image.png')}}">
                        @else
                          <img class="w-20 h-20 rounded-full border" src="{{asset($searchedAccount->icon_image)}}">
                        @endif
                    </div>
                    <div class="my-5">{{$searchedAccount->screen_name}}</div>
                  </div>
                  <div class="flex justify-around mx-5 mb-5">{{$searchedAccount->description}}</div>
                </a>
              </div>
            @endforeach
        </div>
      @else
        <p class="mt-10">表示するアカウントはありません</p>
      @endif

      {{-- ツイート表示 --}}

      @if(!is_null($searchedTweets))
      <div class="max-w-screen-md mt-20 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
        <h2 class="bg-gray-300">ツイート</h2>
          @foreach($searchedTweets as $searchedTweet)
            <div class="border py-5">
              <a href="{{route('tweet.show',['id' => $searchedTweet->id])}}">
                <div class="flex focus:outline-none">
                  <div class="m-5">
                    @if(is_null($searchedTweet->User->UserProfile->icon_image))
                    <img class="w-20 h-20 rounded-full border" src="{{asset('images/no_image.png')}}">
                    @else
                    <img class="w-20 h-20 rounded-full border" src="{{asset($searchedTweet->User->UserProfile->icon_image)}}">
                    @endif
                  </div>
                  <div class="my-5">{{$searchedTweet->User->UserProfile->screen_name}}</div>
                </div>
                <div class="my-5 ml-5">{{$searchedTweet->content}}</div>
                <div class="flex justify-around">
                  @if(!is_null($searchedTweet->image))
                    <img class="w-20 h-20 rounded" src="{{asset($searchedTweet->image)}}">
                  @endif
                </div>
              </a>
              <div class="flex justify-content ml-1">
                  @if(!$searchedTweet->user->canFavorite($searchedTweet->id))
                      <button data-tweet-id="{{$searchedTweet->id}}" id="{{$searchedTweet->id}}" class="favorite btn">いいね</button>
                  @else
                      <button data-tweet-id="{{$searchedTweet->id}}" id="{{$searchedTweet->id}}" class="favorite pushedFavorite">いいね</button>
                  @endif
              </div>
              <div class="mt-2 mx-5 text-s flex justify-end">{{$searchedTweet->updated_at}}</div>
              @endforeach
            </div>
      </div>
      @else
          <p class="mt-10">表示するツイートはありません</p>
      @endif
    </div>
</x-app-layout>