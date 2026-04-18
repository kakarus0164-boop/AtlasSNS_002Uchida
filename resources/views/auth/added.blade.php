<x-logout-layout>
<div class="wrapper">
    <div class="logo-container">
        <h1 class="logo"><img src="{{ asset('images/atlas.png') }}" alt="Atlas"></h1>
        <p class="title">Social Network Service</p>
    </div>
    <div class="login-box register-box">
        <div class="welcome-msg2">{{ session('username') }} さん</div>
        <div class="welcome-msg2">ようこそ！AtlasSNSへ！</div>
        <div class="welcome-msg3">
            <p>ユーザー登録が完了しました。</p>
            <p>早速ログインをしてみましょう。</p>
        </div>

        <a href="{{ route('login') }}" class="btn btn-danger">ログイン画面へ</a>
    </div>

</x-logout-layout>
