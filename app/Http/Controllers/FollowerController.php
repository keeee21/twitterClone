<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FollowerController extends Controller
{
    public function follow(Request $request)
    {
        $userId = Auth::id();
        $followUserId = $request->user_id;
        $isAlreadyFollow = Follower::where('following_id',$userId)->where('follower_id',$followUserId)->first();


        if(!$isAlreadyFollow){ //既にフォローしたか
            $follow = new Follower();
            $follow->following_id = Auth::id();
            $follow->follower_id = $followUserId;
            $follow->save();
        } else {
            $follow = $isAlreadyFollow;
            $follow->delete();
        }
    }

    public function showFollowingUser()
    {
        $follows = Auth::user()->followings;
        return view('follow.follow',compact('follows'));
    }

    public function showFollowerUser()
    {
        $followers = Auth::user()->followers;
        return view('follow.follower',compact('followers'));
    }
}
