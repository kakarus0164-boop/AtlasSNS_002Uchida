<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class FollowsController extends Controller
{
    //
    public function followList()
    {
        //where、whereInも探すという意味
        //where=1つの値を探す、whereIn=複数探す
        $following_id = Auth::user()->followings()->pluck('followed_id');
        $following = User::whereIn('id', $following_id)->get();
        $posts = Post::with('user')->whereIn('user_id', $following_id)->orderBy('created_at', 'desc')->get();
        //最新順にする
        return view('follows.followlist', compact('posts', 'following'));
        // compact関数は（）の中の変数を探す。
        // $〇〇の変数？と同じにしないとエラーが起きる
    }

    public function followerList()
    {
        $follower_id = Auth::user()->followers()->pluck('following_id');
        // get()追加してデータを取得、変数を合わせる
        $followed = User::whereIn('id', $follower_id)->get();
        $posts = Post::with('user')->whereIn('user_id', $follower_id)->orderBy('created_at', 'desc')->get();
        return view('follows.followerlist', compact('posts', 'followed'));
    }

    public function follow($id)
    {
        auth()->user()->followings()->attach($id);
        return back();
    }

    public function unfollow($id)
    {
        auth()->user()->followings()->detach($id);
        return back();
    }
}
