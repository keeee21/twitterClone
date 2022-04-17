<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Models\Tweet;
use App\Models\User;
use App\Models\Reaction;
use App\Models\Follower;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class TweetController extends Controller
{

    
    public function index()
    {

    }


    public function create()
    {
        return view('tweets.create');
    }


    public function store(Request $request)
    {
        // $request->validate([
        //     'content' => 'required|string|min:1|max:140'
        // ]);
        $id = Auth::id();

        $tweet = new Tweet;
        $tweet->fill( [
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);
        $tweet->save();

        // $tweets = Tweet::where('user_id', Auth::id())->get();

        $tweets = Tweet::all();

        // dd($tweets);

        // return view('dashboard',compact('tweets'));
        return redirect()->route('dashboard');


    }

    public function show($id)
    {   
        $tweet = Tweet::find($id);

        return view('tweets.show',compact('tweet'));



        
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function getDashboard(){

        // dd(User::all());
        $tweets = Tweet::all();
        // dd($users);
        return view('dashboard',compact('tweets'));
    }

}
