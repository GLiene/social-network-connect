<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

 //       $posts = Auth::user()->allPostsFromImFollowing();
        $followingToId = [];

        foreach(Auth::user()->following->all() as $user)
        {
            array_push($followingToId, $user->following_to_id);
        }

        array_push($followingToId, Auth::user()->id);

        $posts = Post::whereIn('user_id', $followingToId)->orderBy('updated_at', 'desc')->get();

        return view('home', compact('posts'));
    }
}
