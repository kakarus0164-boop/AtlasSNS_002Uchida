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

          <div class= "profile_icon">
             @if(Auth::user()->icon_image!='icon1.png')
               <img src="{{ asset('storage/'.Auth::user()->icon_image) }}" class="user-icon" alt="icon">
               @else
               <img src="{{ asset('images/icon1.png') }}" class="user-icon" alt="icon">
             @endif
          </div>

        <div class="profile-box">
            {{-- ユーザー名の行 --}}
            <div class="profile-item">

                <label for="username">ユーザー名</label>
                <input type="text" name="username" id="username" value="{{ Auth::user()->username }}">

              </div>

              {{-- メールアドレスの行 --}}
              <div class="profile-item">
                <label for="mail">メールアドレス</label>
                <input type="email" name="mail" id="mail" value="{{ Auth::user()->mail }}">
              </div>

              {{-- パスワードの行 --}}
              <div class="profile-item">
                <label for="password">パスワード</label>
                <input type="password" name="password" id="password">
              </div>

              {{-- パスワード確認の行 --}}
                <div class="profile-item">
                <label for="password_confirmation">パスワード確認</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
              </div>

                {{-- 自己紹介の行 --}}
                <div class="profile-item">
                  <label for="bio">自己紹介</label>
                  <textarea name="bio" id="bio">{{ Auth::user()->bio }}</textarea>
                  <span class="label-name">(任意)</span>
                </div>

                {{-- アイコン画像の行 --}}
                <div class="profile-item">
                  <label for="images">アイコン画像</label>
                  <div class="file-input-wrapper">
                    <input type="file" name="images" id="images">
                  </div>
                  <span class="label-name">(任意)</span>
               </div>
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
