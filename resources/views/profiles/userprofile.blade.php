
@extends('layouts.auth')

@section('content')
<div id="row">
  <div id="container">

   <!-- フォロワーリストのヘッダー部分  -->
  <div class="user-list-header">
      <div class="userprofile">
            @if($users->icon_image!='icon1.png')
            <img src="{{ asset('storage/'.$users->icon_image) }}" class="user-icon" alt="icon">
            @else
            <img src="{{ asset('images/icon1.png') }}" class="user-icon" alt="icon">
            @endif
            <P class="user_p">ユーザー名</P>
            <p class="user_n">{{ $users->username }}</p>
      </div>

      <div class="userprofile-btn">
         <p class="user_bio">自己紹介</P>
         <p class="user_hello">{{ $users->bio }}</p>

        @if(auth()->user()->followings->contains($users->id))

                 <!-- {{-- フォロー済みの場合 --}} -->
                 <form action="{{ route('unfollow', $users->id) }}" method="POST">
                  @csrf
                  <button class="unfollow-btn">フォロー解除</button>
                 </form>

               @else

                 <!-- {{-- 未フォローの場合 --}} -->
                 <form action="{{ route('follow', $users->id) }}" method="POST">
                  @csrf
                  <button class="follow-btn">フォローする</button>
                 </form>
        @endif
      </div>

  </div>

   <!-- 投稿一覧（参考 index.blade） -->
  <div class="timeline">
    @if($posts->isEmpty())
      <p class="no-post">まだ投稿がありません。<p>
    @else

    <!-- $postはcontrollerの中にある、compact関数のpostから引っ張ってきている -->
        @foreach($posts as $post)
          <div class="post">
            <div class="post-left">
              <div class="post-icon">
                 <!-- アイコンをクリックしたらプロフィールへ --}} -->
                <a href="/profile/{{ $post->user->id }}">
                    @if($post->user->icon_image != 'icon1.png')
                      <!-- -- アップロードされた画像を表示（storageを通す） --}} -->
                      <img src="{{ asset('storage/'.$post->user->icon_image) }}" class="user-icon" alt="icon">
                    @else
                      <!-- -- 初期アイコンを表示（直接 images を見る） --}} -->
                      <img src="{{ asset('images/icon1.png') }}" class="user-icon" alt="icon">
                    @endif
               </a>
              </div>

              <div class="post-body">
                <div class="post-header">
                  <p class="post-user">{{ $post->user->username }}</p>
             <div class="post-right-container">
               <p class="post-meta">{{ $post->created_at->format('Y-m-d H:i') }}</p>
             </div>
                </div>
                <p class="post-text">{!! nl2br(e($post->post)) !!}</p>
              </div>

           </div>
           <!-- {{-- 編集・削除ボタンはここには置かない（完成図に合わせる） --}} -->
          </div>
        @endforeach
    @endif
</div>

  </div>
</div>

@endsection
