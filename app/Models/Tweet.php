<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Tweet extends Model
{
    use HasFactory;

    protected $table = 'tweets';

    //可変項目
    protected $fillable = [
        'name',
        'user_id',
        'content',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    //「ツイートが」押されたいいね数
    public function pushedFavoriteBtnCount($tweetId)
    {
        $numOfPushedFavoriteBtn = count(Favorite::where('tweet_id',$tweetId)->get());
        return $numOfPushedFavoriteBtn;
    }
}
