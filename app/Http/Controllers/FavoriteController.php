<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function favorite(Request $request)
    {
        $favoriteTweetId = $request->tweet_id;
        $isAlreadyFavorite = Favorite::where('user_id',Auth::id())->where('tweet_id',$favoriteTweetId)->first();

        if(!$isAlreadyFavorite){ //いいねをしていない場合
            $favorite = new Favorite();
            $favorite->user_id = Auth::id();
            $favorite->tweet_id = $favoriteTweetId;
            $favorite->save();
        } else { //もし既にいいねしてたら
            $isAlreadyFavorite->delete();
        }
        return response()->json(['status' => 200]);
    }

    public function favoriteTweets($userId)
    {
        if(is_null($userId)){
            abort(404);
        }

        $favoriteTweets = User::find($userId)->favorites;
        return view('favorites.favoriteTweets',compact('favoriteTweets'));
    }

    public function favoriteUsers($tweetId)
    {
        if(is_null($tweetId)){
            abort(404);
        }

        $favoriteUsers = Favorite::where('tweet_id',$tweetId)->get();
        return view('favorites.favoriteUsers',compact('favoriteUsers'));
    }
}
