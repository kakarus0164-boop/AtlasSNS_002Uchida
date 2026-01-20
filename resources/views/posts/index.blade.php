@extends('layouts.auth')

@section('content')

{{-- 投稿フォーム --}}
<div class="post-form">
  <form action="{{ route('posts.store') }}" method="POST">
    @csrf

    @error('post')
      <p class="error-message">{{ $message }}</p>
    @enderror

    <textarea
      name="post"
      rows="3"
      placeholder="投稿内容を入力してください"
      class="{{ $errors->has('post') ? 'error' : '' }}"
    >{{ old('post') }}</textarea>

    <button type="submit">投稿</button>
  </form>
</div>

{{-- 投稿一覧 --}}
@if($posts->isEmpty())
  <p class="no-post">まだ投稿がありません。</p>
@else
  @foreach($posts as $post)
    <div class="post">

      <div class="post-icon">
        <img src="https://placehold.jp/50x50.png" alt="{{ $post->user->username }}">
      </div>

      <div class="post-body">
        <div class="post-header">
          <span class="post-user">{{ $post->user->username }}</span>
          <span class="post-meta">{{ $post->created_at->format('Y-m-d') }}</span>
        </div>

        <div class="post-text">
          {!! nl2br(e($post->post)) !!}
        </div>
      </div>

    </div>
  @endforeach
@endif

@endsection
