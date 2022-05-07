<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FavoriteController extends Controller
{
    //いいねする
    public function favorite($tweet)
    {
        $favorite = new Favorite();
        $favorite->user_id = Auth::id();
        $favorite->tweet_id = $tweet;
        $favorite->save();

        return Redirect::back();
    }

    //いいねを解除する
    public function unFavorite($tweet)
    {
        $useId = Auth::id();
        $favorite = Favorite::where('user_id',$useId)->where('tweet_id',$tweet)->first();
        $favorite->delete();
        return Redirect::back();
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
        // dd($favoriteUsers);
        return view('favorites.favoriteUsers',compact('favoriteUsers'));
    }
}
