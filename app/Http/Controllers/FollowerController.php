<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follower;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FollowerController extends Controller
{

    //フォローする
    public function follow(User $user) {
        $follow = new Follower;
        $follow->following_id = Auth::id();
        $follow->follower_id = $user->id;
        $follow->save();

        return Redirect::back();
    }
    //フォロー解除する
    public function unfollow(User $user){
        $follow = Follower::where('following_id',Auth::id())->where('follower_id',$user->id)->first();
        $follow->delete(); //物理削除

        return Redirect::back();
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
