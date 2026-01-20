<aside>
    <!-- ユーザー情報 -->
    <div class="sidebar-user">
        <p>{{ Auth::user()->name ?? 'admin' }}</p>
        <p>投稿数: {{ Auth::user()->posts_count ?? 0 }}</p>
    </div>

    <!-- フォロー情報 -->
    <div class="sidebar-follow">
        <button>フォロー: {{ Auth::user()->follow_count ?? 0 }}</button>
        <button>フォロワー: {{ Auth::user()->follower_count ?? 0 }}</button>
    </div>

    <hr>

    <!-- ユーザー検索ボタン -->
    <div class="sidebar-search">
        <button>ユーザー検索</button>
    </div>
</aside>
