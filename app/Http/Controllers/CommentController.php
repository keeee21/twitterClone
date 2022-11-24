<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(CommentRequest $request, int $tweetId)
    {
        //リプを保存する
        $comment = new Comment;
        $comment->user_id = auth()->id();
        $comment->tweet_id = $tweetId;
        $comment->reply = $request->reply;
        $comment->save();
        
        return redirect()->back();
    }

    public function destroy(int $id)
    {
        $user = Auth::user();
        $destroyingComment = Comment::find($id);

        //削除するユーザーidと、削除されるリプを送信したユーザーidが同じかを判定する
        if($user->checkAuthUserId($destroyingComment->user_id)){
            $destroyingComment->delete();
            return redirect()->route('tweet.show',['id' => $destroyingComment->tweet_id])->with('success','完全に削除しました');
        }
        return redirect()->route('tweet.show',['id' => $destroyingComment->tweet_id])->with('error','許可されていない操作です');
    }
}
