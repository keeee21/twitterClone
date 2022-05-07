<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    public function store(Request $request, $tweet)
    {
        //バリデーションかける
        $request->validate([
            'reply' => 'required|string|max:140',
        ]);

        //リプを保存する
        $comment = new Comment;
        $comment->user_id = auth()->id();
        $comment->tweet_id = $tweet;
        $comment->reply = $request->reply;
        $comment->save();

        if(Auth::user()->checkAuthUserId($comment->users->user_id)){
            $comment->save();
            return Redirect()->back();
        }
        return Redirect::back()->with('error','許可されていない操作です');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $destroyingComment = Comment::find($id);
        if($user->checkAuthUserId($destroyingComment->user_id)){
            $destroyingComment->delete();
            return redirect()->route('tweet.show',['id' => $destroyingComment->tweet_id])->with('success','完全に削除しました');
        }
        return redirect()->route('tweet.show',['id' => $destroyingComment->tweet_id])->with('error','許可されていない操作です');
    }
}
