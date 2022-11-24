<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function reaction()
    {
        return $this->hasMany(Reaction::class);
    }

    public function favorite()
    {
        return $this->hasMany(Favorite::class);
    }
}
