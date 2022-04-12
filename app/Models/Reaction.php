<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    public function Users()
    {
        return $this->hasMany(User::class);
    }

    public function Tweets()
    {
        return $this->hasMany(Tweet::class);
    }


}
