@extends('layouts.auth')

@section('content')
  <div id="row">
  <div id="container">
    {{-- プロフィール編集フォームの塊 --}}
    <div class="profile-edit-box">

            @if ($errors->any())
               <div style="color:red;">
                   <ul>
                        @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- ↑　Laravelを作成する際の合言葉 -->

        {{-- ユーザー名の行 --}}
        <div class="profile-item">
          <label for="username">ユーザー名</label>
          <input type="text" name="username" id="username" value="{{ Auth::user()->username }}">
          <span class="label-name">username</span>
        </div>

        {{-- メールアドレスの行 --}}
        <div class="profile-item">
          <label for="mail">メールアドレス</label>
          <input type="email" name="mail" id="mail" value="{{ Auth::user()->mail }}">
          <span class="label-name">mail</span>
        </div>

        {{-- パスワードの行 --}}
        <div class="profile-item">
          <label for="password">パスワード</label>
          <input type="password" name="password" id="password">
          <span class="label-name">password<br><small>（変更しない場合は現在のものを入力）</small></span>
        </div>

        {{-- パスワード確認の行 --}}
        <div class="profile-item">
          <label for="password_confirmation">パスワード確認</label>
          <input type="password" name="password_confirmation" id="password_confirmation">
          <span class="label-name">password_confirmation</span>
        </div>

        {{-- 自己紹介の行 --}}
        <div class="profile-item">
          <label for="bio">自己紹介</label>
          <textarea name="bio" id="bio">{{ Auth::user()->bio }}</textarea>
          <span class="label-name">bio(任意)</span>
        </div>

        {{-- アイコン画像の行 --}}
        <div class="profile-item">
          <label for="images">アイコン画像</label>
          <div class="file-input-wrapper">
            <input type="file" name="images" id="images">
          </div>
          <span class="label-name">images(任意)</span>
        </div>

        {{-- 更新ボタン --}}
        <div class="profile-submit">
          <button type="submit" class="update-btn">更新</button>
        </div>

      </form>
    </div>
  </div>
</div>
@endsection
