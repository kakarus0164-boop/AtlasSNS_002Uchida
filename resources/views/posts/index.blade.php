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

        <div class="post-left">
          <div class="post-icon">
            <img src="https://placehold.jp/50x50.png" alt="{{ $post->user->username }}">
          </div>

            <div class="post-body">
              <div class="post-header">
                <div class="post-user">{{ $post->user->username }}</div>
              </div>

          <div class="post-text">
            {!! nl2br(e($post->post)) !!}
          </div>
        </div>
      </div>

        <div class="post-right">
          <div class="post-meta">
            {{ $post->created_at->format('Y-m-d') }}
          </div>
        </div>

        @if(Auth::id() === $post->user_id)
          <div class="post-actions">

              {{-- 編集（モーダルを開く --}}
              <button
                 type="button"
                 class="edit-btn"
                 data-id="{{ $post->id }}"
                 data-post="{{ e($post->post) }}"
              >
                <img src="{{ asset('images/edit.png') }}" class="normal" alt="編集">
                <img src="{{ asset('images/edit_h.png') }}" class="hover" alt="編集">
              </button>

              {{-- 削除 --}}
              <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn" onclick="return confirm('削除しますか？')">
                  <img src="{{ asset('images/trash.png') }}" class="normal" alt="削除">
                  <img src="{{ asset('images/trash-h.png') }}" class="hover"
                   alt="削除">
                </button>
              </form>

          </div>
        @endif

      </div>
  @endforeach
@endif


    {{-- 編集モーダル --}}
    <div id="edit-modal" class="modal">
      <div class="modal-content">

        <form method="POST" id="edit-form">

          @csrf
          @method('PUT')

          <input type="hidden" name="post_id" id="edit-post-id">

          <textarea
            name="post"
            id="edit-post-content"
            maxlength="150"
            rows="5"
          ></textarea>

          <div class="modal-buttons">
            <button type="submit">更新</button>
            <button type="button" id="close-modal">キャンセル</button>
          </div>

        </form>
      </div>
    </div>

    {{-- js --}}
    <script>
      document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', () => {
           const postId = btn.dataset.id;

           document.getElementById('edit-post-id').value = btn.dataset.id;
           document.getElementById('edit-post-content').value = btn.dataset.post;

           document.getElementById('edit-form').action = `/posts/${postId}`;

           document.getElementById('edit-modal').style.display = 'block';
        });
      });

       document.getElementById('close-modal').addEventListener('click', () => {
            document.getElementById('edit-modal').style.display = 'none';
      });
    </script>

    @endsection
