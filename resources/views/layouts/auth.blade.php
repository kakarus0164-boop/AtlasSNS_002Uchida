<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>AtlasSNS</title>
  <!-- Bootstrapをベースにして、CSSで上書きするためにBoot~が最初に入れる -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="auth">

   <!-- ヘッダー -->
  <header>
      <a href="{{ route('posts.index') }}" class="logo">
        <img src="{{ asset('images/atlas.png') }}" alt="Atlasロゴ">
      </a>

      <div class="user-menu">
          <span class="user-name">
            {{ Auth::user()->name ?? 'admin' }} さん
          </span>

          <!-- >の下向き -->
          <span class="dropdown-arrow"></span>

         <!-- ユーザーアイコン -->
         <img src="{{ asset('images/icon1.png') }}" alt="ユーザーアイコン" class="user-icon">

         <!-- ドロップダウンメニュー -->
         <ul class="dropdown-menu">
            <li><a href="{{ route('posts.index') }}">HOME</a></li>
            <li><a href="{{ route('users.profile') }}">プロフィール編集</a></li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                  ログアウト
                </button>
              </form>
            </li>
        </ul>
      </div>
  </header>

    <!-- main layout -->
  <div class="container-fluid">
    <div class="row">

      <!-- メインコンテンツ（投稿一覧など） -->
      <!-- メイン（左） -->
      <div class="col-md-9">
        @yield('content')
      </div>

      <!-- サイドバー（右） -->
      <div class="col-md-3">
        @include('layouts.sidebar')
      </div>

    </div>
  </div>

<!-- Bootstrapはcssの上に -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const userMenu = document.querySelector('.user-menu');
    const arrow = document.querySelector('.dropdown-arrow');
    const menu = document.querySelector('.dropdown-menu');

    userMenu.addEventListener('click', function (e) {
        e.stopPropagation();
        menu.classList.toggle('show');
        arrow.classList.toggle('open');
    });

    document.addEventListener('click', function () {
        menu.classList.remove('show');
        arrow.classList.remove('open');
    });

});
</script>
</body>
</html>
