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
        $userId = Auth::id();

        $user = User::find($userId) ?? new User();

        $userProfile = $user->userProfile ?? new UserProfile();

        return view('profiles/create',compact('userProfile'));
    }

    public function storeOrUpdate(Request $request)
    {
        $userId = Auth::id();
        $user = User::find($userId) ?? new User();
        $userProfile = $user->userProfile ?? new UserProfile();

        $params = $request->all();
        $params = array_merge($params,['user_id' => $userId]);
        $userProfile->fill($params);
        $userProfile->save();

        return redirect()->route('dashboard');
    }

    public function show($id)
    {
        $profile = UserProfile::where('user_id', $id)->first();

        return view('profiles/show',compact('profile'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}


