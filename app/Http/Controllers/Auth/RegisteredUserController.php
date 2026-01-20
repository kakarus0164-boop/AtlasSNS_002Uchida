<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // ▼ バリデーション追加
        $request->validate([
            'username' => ['required', 'string', 'min:2', 'max:12'],
            'email'    => [
                'required', //必須
                'string', //
                'email',
                'min:5',
                'max:40',
                'unique:users,email'
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
        ]);

        // ▼ ユーザー作成
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 登録したユーザー名をセッションへ保存
        session(['username' => $user->username]);

        // 完了ページへ
        return redirect()->route('added'); //URLは変わるけど、名前は変わらないからrouteを使う
    }

    public function added(): View
    {
        return view('auth.added');
    }
}
