<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class ProfileController extends Controller
{
    public function create()
    {   
        return view('profiles/create');
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        $userProfile = new UserProfile();
        $params = $request->all();
        $params = array_merge($params,['user_id' => $userId]);
        $userProfile->fill($params);
        $userProfile->save();

        return redirect()->route('dashboard');
    }

    public function show($id)
    {
        // $profile = UserProfile::where('user_id', $id)->first();
        $profile = UserProfile::orderBy('created_at','desc')->where('user_id',$id)->first();

        return view('profiles/show',compact('profile'));
    }

    public function edit($id)
    {
        $userProfile = UserProfile::orderBy('created_at','desc')->where('user_id',$id)->first();
        return view('profiles.edit',compact('userProfile'));
    }

    public function update(Request $request)
    {
        $userId = Auth::id();
        $userProfile = UserProfile::where('user_id',$userId)->first();
        $params = $request->all();
        $params = array_merge($params,['user_id' => $userId]);
        $userProfile->fill($params);
        $userProfile->save();

        return redirect('dashboard');
    }


    public function destroy($id)
    {
        //
    }
    
}


