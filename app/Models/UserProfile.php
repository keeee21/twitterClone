<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'user_profiles';

    //可変項目
    protected $fillable = [
        'user_id',
        'screen_name',
        'description',
        'location',
        'url',
        'icon_image',
        'header_image',
    ];


    public function user()
    {
        return $this->belongsTo(User::class); 
    }
}
