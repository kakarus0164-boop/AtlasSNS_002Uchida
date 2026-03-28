<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function update(Request $request){
        //大文字のリクエスト→送られてきた投稿データ入っている
        // $request→使いやすくするために、変数に変えている。
        $user = Auth::user();

        $request->validate(
            [
              'username' => ['required', 'string', 'min:2', 'max:12'],
              'mail'    => [
                'required', //必須
                'string', //
                'email',
                'min:5',
                'max:40',
                'unique:users,email,' .Auth::id(),
                // Auth::id()で私のIDが全てまるっと除外になる
            ],
            'password' => [
                 'required',
                 'alpha_num', //英語＋数字
                 'min:8',
                 'max:20',
            ],
             'password_confirmation' => [
                'required',
                'alpha_num',
                'min:8',
                'max:20',
                'same:password' // ← password と同じかチェック
            ],
            'bio' => [
                'max:150',
            ],

            'images' => [
                'file', 'mimes:jpeg,png,jpg,bmp,gif,svg'
            ]
        ]);

        if ($request->hasFile('images')) {

        // $imageUpdate = $request->file('images')->getClientOriginalName();
        $image = $request->file('images')->store('public');
        // store　=　Laravelが自動で名前を決める
        // storeAs = 自分でファイル名を指定できる
        }
        $user->update([
        'username' => $request->username,
        'email' => $request->mail,
        'password' => Hash::make($request->password),
          // データベースに入れるときのパスワードを丸見えにしないため
          // Hash ・・元に戻せない、ランダムな文字列にする。（だからデータベースには解読不可能な文字列が並べられる
        'bio' => $request->bio,
        'icon_image' => $image,
        ]);

        return redirect()->route('posts.index');
        //XDより、更新したらTOPページに行けと指示あり
        //更新をかけて（）で指定したページに飛ぶから、viewじゃなくredirect(要求して別ページに移動する)にする
    }
}
