<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;


class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'post' => ['required', 'min:5', 'max:500']
        ]);

        $post = new Post();
        $post->post = $request->input('post');
        $request->user()->posts()->save($post);

        return redirect('home');
    }

    public function edit(Post $post)
    {

    }

    public function update(Request $request, Post $post)
    {
        $post->update([
            'user_id' => $post->user_id,
            'post' => $post->post,
            'updated_at' => now()
        ]);
    }


    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('/');
    }
}
