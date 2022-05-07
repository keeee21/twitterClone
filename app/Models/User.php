<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;
use App\Models\Follower;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //フォローできる対象かどうかをチェック
    public function canFollow($userId)
    {
        return Follower::where('following_id',Auth::id())->where('follower_id',$userId)->first();
    }
    //フォローしている数=フォロー数
    public function followCount()
    {
        $followCount = count(Follower::where('following_id',Auth::id())->get());
        return $followCount;
    }

    //フォローされている数＝フォロワー数
    public function followerCount()
    {
        $followerCount = count(Follower::where('follower_id',Auth::id())->get());
        return $followerCount;
    }

    //いいねを押して良いかどうか
    public function canFavorite($tweet)
    {
        return Favorite::where('user_id',Auth::id())->where('tweet_id',$tweet)->first();
    }

    //「ユーザーが押した」いいね数
    public function favoriteCount()
    {
        $favoriteCount = count(Favorite::where('user_id',Auth::id())->get());
        return $favoriteCount;
    }

    public function checkAuthUserId($user_id)
    {
        return $this->id == $user_id;
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    public function userProfile()
    {
            return $this->hasOne(UserProfile::class);
    }

    //いいね
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // フォロー
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers','following_id','follower_id');
    }
    //フォロワー
    public function followers()
    {
        return $this->belongsToMany(User::class,'followers','follower_id','following_id');
    }

    // public function comments()
    // {
    //     return $this->hasMany(Comment::class,'user_id','id');
    // }
}
