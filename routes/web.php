<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



require __DIR__ . '/auth.php';

Route::get('/added', [RegisteredUserController::class, 'added'])->name('added');

Route::middleware('auth')->group(function () {
  //トップ（投稿一覧）
  Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
  // トップ（投稿一覧）
  Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
  //自分のプロフィール
  Route::get('/users/profile', [ProfileController::class, 'profile'])->name('users.profile');
  //ユーザー検索画面
  Route::get('/users/search', [UsersController::class, 'search'])->name('users.search');
  //検索結果
  Route::get('/users/search_result', [UsersController::class, 'searchResult'])->name('users.search.result');
  //フォロー一覧
  Route::get('/follows/followlist', [FollowsController::class, 'followList'])->name('follows.followlist');
  //フォロー一覧
  Route::get('/follows/followerlist', [FollowsController::class, 'followerList'])->name('follows.followerlist');
  //他ユーザーのプロフィール
  Route::get('/users/{id}' , [ProfileController::class, 'show'])->name('users.show');
});

Route::middleware('auth')->get('/auth-test', function () {
    return 'auth OK';
});
