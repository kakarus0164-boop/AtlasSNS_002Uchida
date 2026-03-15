
@extends('layouts.auth')

@section('content')

{{-- 検索ホーム --}}
<div class="search-container">
   <form action="{{ route('users.search') }}" method="GET"  class="search-container">
      <input type="text" name="search" placeholder="ユーザー名" value="{{ request('search') }}">
      <button type="submit">検索</button>
   </form>

     @if(isset($search))
     <!-- 検索ボタンの判定 検索ボタンが押された時にtrue -->
      <h3>{{ "検索ワード：" .request('search') }}</h3>
      <!-- 文字列と変数をくっつけるのは「.」 -->
     @endif
</div>



       @foreach($users as $user) <!-- 引っ張り出したい値（変数）を整列させてより取り出しやすくするため -->
         <div class ="username">
            <div class="user-left">
              <img src="{{ asset('images/' . ($user->icon_image ?? 'default.png')) }}" class="user-icon">
              <p class="user">{{ $user->username }}</p>
            </div>

            @if(auth()->user()->followings->contains($user->id))

              {{-- フォロー済みの場合 --}}
              <form action="{{ route('unfollow', $user->id) }}" method="POST">
               @csrf
               <button class="unfollow-btn">フォロー解除</button>
              </form>

            @else

              {{-- 未フォローの場合 --}}
              <form action="{{ route('follow', $user->id) }}" method="POST">
               @csrf
               <button class="follow-btn">フォローする</button>
              </form>
            @endif

         </div>
       @endforeach

@endsection
