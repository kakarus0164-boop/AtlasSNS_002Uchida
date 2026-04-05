@extends('layouts.auth')

@section('content')
<div id="row">
  {{--左側--}}
  <div id="container">

  {{-- 投稿フォーム --}}
  <div class="post-form">
    <form action="{{ route('posts.store') }}" method="POST">
      @csrf
      @if(Auth::user()->icon_image!='icon1.png')
            <img src="{{ asset('storage/'.Auth::user()->icon_image) }}" class="user-icon" alt="icon">
            @else
            <img src="{{ asset('images/icon1.png') }}" class="user-icon" alt="icon">
      @endif
      <!-- Auth::user →　ログインしているユーザー -->

      <textarea
        name="post"
        rows="3"
        placeholder="投稿内容を入力してください"
        class="{{ $errors->has('post') ? 'error' : '' }}"
      >{{ old('post') }}</textarea>

      <button type="submit" class="post-btn">
        <img src="{{ asset('images/post.png') }}" alt="投稿">
</button>
    </form>

    @error('post')
      <p class="error-message">{{ $message }}</p>
    @enderror

</div>

{{-- 投稿一覧 --}}
<div class="timeline">
  @if($posts->isEmpty())
    <p class="no-post">まだ投稿がありません。</p>
  @else

     @foreach($posts as $post)
        <div class="post">
          <div class="post-left">
               <div class="post-icon">
                  @if($post->user->icon_image!='icon1.png')
                  <img src="{{ asset('storage/'.$post->user->icon_image) }}" class="user-icon" alt="icon">
                  @else
                  <img src="{{ asset('images/icon1.png') }}" class="user-icon" alt="icon">
                  @endif
               </div>

               <div class="post-body">
                   <div class="post-header">
                       <p class="post-user">{{ $post->user->username }}</p>
                       <p class="post-meta">{{ $post->created_at->format('Y-m-d H:i') }}</p>
                   </div>
                   <p class="post-text">{!! nl2br(e($post->post)) !!}</p>
               </div>
          </div>

          <div class="post-right">
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
              <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
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

      </div>
  @endforeach
@endif
</div>

    {{-- 編集モーダル --}}
    <div id="edit-modal" class="edit-modal">
      <div class="edit-modal-content">

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
