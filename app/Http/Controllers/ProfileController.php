<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tweet;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $id = Auth::id();

        $user = User::find($id) ?? new User();

        if (is_null(($user->userProfile))) {
            $registered = new UserProfile();
        } else {
            $registered = $user->userProfile;
        };

        return view('profiles/create',compact('registered'));
    }

    

    public function store(Request $request)
    {
        $id = Auth::id();

        $user = User::find($id) ?? new User();

        if (is_null(($user->userProfile))) {
            //新規の処理
            $data = new UserProfile();
        } else {
            //既存データの処理
            $data = UserProfile::where('user_id', $id)->first();
        };

        $data->user_id = Auth::id();
        $data->screen_name = $request->input('screen_name');
        $data->description = $request->input('description');
        $data->location = $request->input('location');
        $data->url = $request->input('url');
        $data->icon_image = $request->input('icon_image');
        $data->header_image = $request->input('header_image');

        $data->save();


        return redirect()->route('dashboard');
    }


    public function show($id)
    {
        // dd($id);
        $profile = UserProfile::where('user_id', $id)->first();
        // dd($profile);
        return view('profiles/show',compact('profile'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    public function goDashboard()
    {
        $tweets = Tweet::all();

        return view('dashboard',compact('tweets'));
    }

    
}


