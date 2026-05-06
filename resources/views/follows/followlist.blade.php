@extends('layouts.auth')

@section('content')
<div id="row">
  <div id="container">

   <!-- フォローリストのヘッダー部分 --}} -->
  <div class="follower-list-header">
      <div class="list-title">
        <h2>フォローリスト</h2>
      </div>
      <div class="follower-icon">
        @foreach($following as $user)
          <a href="/profile/{{ $user->id }}">
            @if($user->icon_image!='icon1.png')
            <img src="{{ asset('storage/'.$user->icon_image) }}" class="user-icon" alt="icon">
            @else
            <img src="{{ asset('images/icon1.png') }}" class="user-icon" alt="icon">
            @endif
          </a>
        @endforeach
     </div>
  </div>

  <!-- {{-- 投稿一覧（参考 index.blade） --}} -->
  <div class="timeline">
    @if($posts->isEmpty())
      <p class="no-post">まだ投稿がありません。</p>
    @else
        @foreach($posts as $post)
          <div class="post">
              <div class="post-icon">
                <!-- {{-- アイコンをクリックしたらプロフィールへ --}} -->
                <a href="/profile/{{ $post->user->id }}">
                  @if($post->user->icon_image!='icon1.png')
                  <img src="{{ asset('storage/'.$post->user->icon_image) }}" class="user-icon" alt="icon">
                  @else
                  <img src="{{ asset('images/icon1.png') }}" class="user-icon" alt="icon">
                  @endif
               </a>
              </div>

              <div class="post-body">
                  <p class="post-user">{{ $post->user->username }}</p>
                  <div class="post-content">
                    <p class="post-text">{!! nl2br(e($post->post)) !!}</p>
                  </div>

                </div>
                <div class="post-right-container">
                  <p class="post-meta">{{ $post->created_at->format('Y-m-d H:i') }}</p>
                </div>

           </div>
           <!-- {{-- 編集・削除ボタンはここには置かない（完成図に合わせる） --}} -->

        @endforeach
    @endif
</div>
</div>
</div>

@endsection
