<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Traits\saveImage;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    use saveImage;

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

        $userId = Auth::id();
        $tweet = new Tweet;
        $tweet->user_id = $userId;
        $tweet->content = $request->content;
        $tweet->image = $this->saveImage($request->tweetImage);

        if(Auth::user()->checkAuthUserId($tweet->user_id)){
            $tweet->save();
            return redirect()->route('dashboard');
        }
        return Redirect::back()->with('error','許可されていない操作です');
    }

    public function show($id)
    {   
        $tweet = Tweet::find($id);
        if(is_null($tweet)){
            abort(404);
        }

        $comments = Comment::where('tweet_id',$id)->get();

        $numOfFavoriteBtn = $tweet->pushedFavoriteBtnCount($id);
        return view('tweets.show',compact('tweet','numOfFavoriteBtn','comments'));
    }

    public function edit($id)
    {
        $tweet = Tweet::find($id);
        if(is_null($tweet)){
            abort(404);
        }
        $user = User::find(Auth::id());
        return view('tweets.edit',compact('user','tweet'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(self::RULES);

        $updateTweet = Tweet::find($id);

        $updateTweet->content = $request->content;
        $updateTweet->image = $this->saveImage($request->tweetImage);

        if(Auth::user()->checkAuthUserId($updateTweet->user_id)){
            $updateTweet->save();
            return redirect()->route('tweet.show',['id' => $updateTweet->id]);
        }
        return redirect()->route('dashboard')->with('error','許可されていない操作です');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $tweet = Tweet::find($id);
        if($user->checkAuthUserId($tweet->user_id)){
            $tweet->delete();
            return redirect()->route('profile.index')->with('success','完全に削除しました');
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