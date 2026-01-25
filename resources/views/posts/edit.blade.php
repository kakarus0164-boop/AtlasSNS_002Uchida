@extends('layouts.auth')

@section('content')

<div class="post-form">
  <form action="{{ route('posts.update', $post->id) }}" method="POST">
    @csrf
    @method('PUT')

    @error('post')
      <p class="error-message">{{ $message }}</p>
    @enderror

    <textarea name="post" rows="3">{{ old('post', $post->post) }}</textarea>

    <button type="submit">更新</button>
  </form>
</div>

@endsection
