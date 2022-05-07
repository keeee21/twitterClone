<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $profiles = UserProfile::where('user_id','!=',$userId)->get();

        return view('users.index',compact('profiles'));
    }
}
