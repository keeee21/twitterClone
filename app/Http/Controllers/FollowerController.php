<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function follow(Request $request)
    {
        $userId = Auth::id();
        $followUserId = $request->user_id;
        $isAlreadyFollow = Follower::where('following_id',$userId)->where('follower_id',$followUserId)->first();

        if(!$isAlreadyFollow){ //フォローをしていない場合
            $follow = new Follower();
            $follow->following_id = Auth::id();
            $follow->follower_id = $followUserId;
            $follow->save();
        } else {
            $follow = $isAlreadyFollow;
            $follow->delete();
        }
        
        return response()->json(['status' => 200]);
    }

    public function showFollowingUser($id)
    {
        $user = User::find($id);
        if(is_null($user)){
            abort(404);
        }
        $follows = $user->followings;
        return view('follow.follow',compact('follows'));
    }

    public function showFollowerUser($id)
    {
        $user = User::find($id);
        if(is_null($user)){
            abort(404);
        }
        $followers = $user->followers;
        return view('follow.follower',compact('followers'));
    }
}
