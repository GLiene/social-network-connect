<?php

namespace App\Http\Controllers;

use App\Follower;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allFollowingTo()
    {
        $followingToId = [];

        foreach (Auth::user()->following->all() as $user) {
            array_push($followingToId, $user->following_to_id);
        }

        $followingAll = User::whereIn('id', $followingToId)->orderBy('name', 'asc')->get();

        return view('follow.following', compact('followingAll'));
    }

    public function follow(Request $request, User $user)
    {
        if (Auth::user()->following()->where('following_to_id', $user->id)->value('following_to_id') !== $user->id) {
            $following = new Follower();
            $following->user_id = Auth::user()->id;
            $following->following_to_id = $user->id;
            $request->user()->following()->save($following);
        }

        return redirect('/profile/' . $user->id);
    }

    public function unfollow(User $user)
    {
        $followingAll = Auth::user()->following()->get();

        foreach ($followingAll as $following) {
            if ($following->following_to_id === $user->id) {
                $following->delete();
            }
        }

        return redirect('/profile/' . $user->id);
    }

}
