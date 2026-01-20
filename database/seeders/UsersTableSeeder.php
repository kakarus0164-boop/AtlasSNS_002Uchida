<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // ユーザーモデルのインポート

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
           'username' => 'テストユーザー',       // ユーザー名
           'email' => 'test@example.com',    // メールアドレス
           'password' => bcrypt('password'),  // パスワードのハッシュ化
           'bio' => '初期ユーザーです',
           'icon_image' => 'default.png',
       ]);
    }
}
