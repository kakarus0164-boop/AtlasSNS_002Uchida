<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;


class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
              'post' => 'required|max:150',
            ],
            [
              'post.required' => '投稿内容は必須です',
              'post.max' => '投稿は150文字以内で入力してください',
            ]
        );

        Post::create([
            'user_id' => Auth::id(),
            'post' => $request->post,
        ]);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403);
        }
        $post->delete();
        return redirect()->route('posts.index');
    }
}
