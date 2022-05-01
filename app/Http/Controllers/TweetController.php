<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Models\Tweet;
use App\Models\User;
use App\Models\Reaction;
use App\Models\Follower;
use App\Models\UserProfile;
use App\Traits\saveImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TweetController extends Controller
{
    use saveImage;

    public function create()
    {
        return view('tweets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:140',
            'tweetImage' =>'image|mimes:jpeg,png,jpg|max:2048',
        ]);

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

        $pushedFavoriteBtnCount = $tweet->pushedFavoriteBtnCount($id);
        return view('tweets.show',compact('tweet','pushedFavoriteBtnCount'));
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

    public function getDashboard(){

        $tweets = Tweet::orderBy('created_at','desc')->get();
        // $profiles = UserProfile::all();
        $user = new User;
        return view('dashboard',compact('tweets','user'));
    }

}