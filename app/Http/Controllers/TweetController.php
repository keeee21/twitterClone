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
        





        // dd($request);
        $tweet = new Tweet;

        $tweet->fill( [
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        $tweet->save();

        // $tweets = Tweet::where('user_id', Auth::id())->get();

        $tweets = Tweet::all();

        // dd($tweets);

        return view('dashboard',compact('tweets'));

    }

    public function show($id)
    {   
        // $tweet = Tweet::find($id);
        // return view('tweet.show',compact('tweet'));
        
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

}
