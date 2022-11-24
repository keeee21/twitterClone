<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Tweet;
use App\Models\UserProfile;

class SearchController extends Controller
{
    public function show(SearchRequest $request)
    {
        $keyword = $request->keyword;

        //allだった場合
        if($request->category === 'all'){
            $searchedAccounts = UserProfile::where('screen_name','like','%'.$keyword.'%')->get();
            $searchedTweets = Tweet::where('content','like','%'.$keyword.'%')->get();

            return view('search',compact('searchedAccounts','searchedTweets'));
        }

        //account検索だった場合
        if($request->category === 'account'){
            $searchedAccounts = UserProfile::where('screen_name','like','%'.$keyword.'%')->get();
            $searchedTweets = Tweet::where('content','like',"")->get();

            return view('search',compact('searchedAccounts','searchedTweets'));
        }

        //tweet検索だった場合
        if($request->category === 'tweet'){
            $searchedTweets = Tweet::where('content','like','%'.$keyword.'%')->get();
            $searchedAccounts = UserProfile::where('screen_name','like',"")->get();

            return view('search',compact('searchedTweets','searchedAccounts'));
        }
    }
}
