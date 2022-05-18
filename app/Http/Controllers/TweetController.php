<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Traits\SaveImage;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    use SaveImage;

    const RULES = [
        'content' => 'required|string|max:140',
        'tweetImage' =>'image|mimes:jpeg,png,jpg|max:2048',
    ];

    public function create()
    {
        return view('tweets.create');
    }

    public function store(Request $request)
    {
        $request->validate(self::RULES);

        $tweet = new Tweet;
        $tweet->user_id = Auth::id();
        $tweet->content = $request->content;
        $tweet->image = $this->saveImage($request->tweetImage);
        $tweet->save();
            
        return redirect()->route('dashboard');
    }

    public function show($clickedTweetId)
    {   
        $clickedTweet = Tweet::find($clickedTweetId);
        if(is_null($clickedTweet)){
            abort(404);
        }

        $comments = Comment::where('tweet_id',$clickedTweetId)->get();

        $numOfPushedFavoriteBtn = $clickedTweet->pushedFavoriteBtnCount($clickedTweetId);
        return view('tweets.show',compact('clickedTweet','numOfPushedFavoriteBtn','comments'));
    }

    public function edit($editingTweetId)
    {
        $editingTweet = Tweet::find($editingTweetId);
        $authUser = User::find(Auth::id());

        //$tweetは存在するか
        if(is_null($editingTweet)){
            abort(404);
        }
        //ツイートがログインユーザーによって作成されたか
        if(!$editingTweet->isCreatedByUser(Auth::id())){
            abort(404);
        }
        return view('tweets.edit',compact('authUser','$editingTweet'));
    }

    public function update(Request $request, $updateTweetId)
    {
        $request->validate(self::RULES);

        $updateTweet = Tweet::find($updateTweetId);
        $updateTweet->content = $request->content;
        $updateTweet->image = $this->saveImage($request->tweetImage);

        if(Auth::user()->checkAuthUserId($updateTweet->user_id)){
            $updateTweet->save();
            return redirect()->route('tweet.show',['id' => $updateTweet->id]);
        }
        return redirect()->route('dashboard')->with('error','許可されていない操作です');
    }

    public function destroy($destroyingTweetId)
    {
        $destroyingTweet = Tweet::find($destroyingTweetId);

        if(Auth::user()->checkAuthUserId($destroyingTweet->user_id)){
            $destroyingTweet->delete();
            return redirect()->route('dashboard')->with('success','完全に削除しました');
        }
        return redirect()->route('dashboard')->with('error','許可されていない操作です');
    }

    public function getDashboard()
    {
        $tweets = Tweet::orderBy('created_at','desc')->get();
        $user = new User;
        
        return view('dashboard',compact('tweets','user'));
    }
}