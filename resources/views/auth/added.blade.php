<x-logout-layout>
  <div id="clear">
    <p>{{ session('username') }} さん</p>
    <p>ようこそ！AtlasSNSへ！</p>
    <p>ユーザー登録が完了しました。</p>
    <p>早速ログインをしてみましょう。</p>

    <button type="submit" class="btn btn-danger"><a href="login">ログイン画面へ</a></button>
  </div>
</x-logout-layout>
