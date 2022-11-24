<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'tweet_id',
        'tweet_type_id',
        'content',
    ];

    public function Users()
    {
        return $this->belongsTo(User::class);
    }

    public function Tweets()
    {
        return $this->belongsTo(Tweet::class);
    }


}
