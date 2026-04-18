<x-logout-layout>
<div class="wrapper">
    <div class="logo-container">
        <h1 class="logo"><img src="{{ asset('images/atlas.png') }}" alt="Atlas"></h1>
        <p class="title">Social Network Service</p>
    </div>
    <div class="login-box register-box">
        <div class="welcome-msg2">{{ session('username') }} さん</div>
        <div class="welcome-msg2">ようこそ！AtlasSNSへ！</div>
        <div class="welcome-msg2">ユーザー登録が完了しました。</div>
        <div class="welcome-msg2">早速ログインをしてみましょう。</div>

        <button type="submit" class="btn btn-danger"><a href="login">ログイン画面へ</a></button>
    </div>

</x-logout-layout>
