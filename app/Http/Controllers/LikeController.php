<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Post $post)
    {
        Auth::user()->likes()->create([
            'likeable_id' => $post->id,
            'likeable_type' => 'POST',
        ]);

        return redirect('home');
    }

    public function unlike(Post $post)
    {
        Auth::user()->likes()->where('likeable_id', $post->id)->delete();

        return redirect('home');

    }
}
