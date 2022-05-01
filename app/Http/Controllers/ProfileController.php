<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use App\Traits\saveImage;
use App\Models\Follower;




class ProfileController extends Controller
{
    use saveImage;

    const RULES = [
        'screen_name' => 'required|string|max:30',
        'url' => 'nullable|url',
        'icon_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'header_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ];

    public function index()
    {
        $userId = Auth::id();
        $user = User::find($userId);

        return view('profiles.index',compact('user'));
    }

    public function show($id)
    {
        $user = User::find($id);
        if(is_null($user)){
            abort(404);
        }
        return view('profiles.show',compact('user'));
    }

    public function edit()
    {
        $user = User::find(Auth::id());
        return view('profiles.edit',compact('user'));
    }

    public function update(Request $request)
    {

        $request->validate(self::RULES);

        $userProfile = Auth::user()->UserProfile::where('user_id',Auth::id())->first();
        $userProfile->user_id = Auth::id();
        $userProfile->screen_name = $request->screen_name;
        $userProfile->description = $request->description;
        $userProfile->location = $request->location;
        $userProfile->url = $request->url;
        $userProfile->icon_image = $this->saveImage($request->icon_image);
        $userProfile->header_image = $this->saveImage($request->header_image);
        $userProfile->save();

        return redirect()->route('profile.index');
    }
}


