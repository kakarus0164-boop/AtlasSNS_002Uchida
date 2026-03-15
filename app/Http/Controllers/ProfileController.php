<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Post;


class ProfileController extends Controller
{
    public function profile(){
        return view('profiles.profile');
    }

    // 他フォロワーのプロフィール
    // ()はURLで送られてきたIDが格納されている（１だったら１、２だったら２のIDを表示？する）
    public function userprofile($id){
        // ()の中　左→フォルダ、右→ファイル名

        $posts = Post::where('user_id', $id)->orderBy('created_at', 'desc')->get();

        $users = User::where('id',$id)->first();

        // $変数＝compact変数の（）中の名前は同じにする（ひっぱる）
        return view('profiles.userprofile', compact('posts','users'));

    }
}
