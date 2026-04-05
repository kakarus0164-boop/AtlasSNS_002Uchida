<aside>
    <!-- ユーザー情報 -->
    <div class="sidebar-user">
        <p>{{ Auth::user()->username ?? 'admin' }}さんの</p>
    </div>

    <!-- フォロー情報 -->
    <div class="sidebar-follow">
    <!-- count()の()の中身が空欄　→　理由は数を数えるだけだから -->
    <!-- a hrefはAの場所からBの場所へ移動したいだけの場合に有効 -->
        <p>フォロー{{ Auth::user()->followings ->count() }}</p>
        <a href="{{ route('follows.followlist') }}" class="btn btn-primary">フォローリスト</a>
        <p>フォロワー{{ Auth::user()->followers ->count() }}</p>
        <a href="{{ route('follows.followerlist') }}" class="btn btn-primary">フォロワーリスト</a>
    </div>

    <hr>

    <!-- ユーザー検索ボタン -->
    <div class="sidebar-search">
        <a href="{{ route('users.search') }}" class="btn btn-primary">ユーザー検索</a>
    </div>
</aside>
