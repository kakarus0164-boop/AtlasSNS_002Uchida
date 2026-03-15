<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function search(Request $request){
        $search = $request -> input ('search');

        if(!empty($search)){
            // !=ノットイコール　
            $users = User::where('username', 'like', '%'.$search.'%') -> where("id" , "!=" , Auth::user()->id)  -> get();
        } else {
            $users = User::where("id" , "!=" , Auth::user()->id) -> get();
        }

        return view('users.search', compact('users', 'search'));
        //return はbladeに返す（表示してねと指示する）コード
        //compactはbladeに変数を送るための関数（コンパクトに梱包→発送）
    }
}
