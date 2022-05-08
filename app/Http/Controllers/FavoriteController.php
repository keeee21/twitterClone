<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function favorite(Request $request)
    {
        $userId = Auth::id();
        $favoriteTweetId = $request->tweet_id;
        $isAlreadyFavorite = Favorite::where('user_id',$userId)->where('tweet_id',$favoriteTweetId)->first();

        if(!$isAlreadyFavorite){ //いいねをしていない場合
            $favorite = new Favorite();
            $favorite->user_id = Auth::id();
            $favorite->tweet_id = $favoriteTweetId;
            $favorite->save();
        } else { //もし既にいいねしてたら
            $isAlreadyFavorite->delete();
        }
    }

    public function favoriteTweets()
    {
        $favoriteTweets = Auth::user()->favorites;
        return view('favorites.favoriteTweets',compact('favoriteTweets'));
    }

    public function favoriteUsers($id)
    {
        $tweetId = $id;
        $favoriteUsers = Favorite::where('tweet_id',$tweetId)->get();
        return view('favorites.favoriteUsers',compact('favoriteUsers'));
    }
}
