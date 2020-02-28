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
            Auth::user()->following()->create([
                'following_to_id' => $user->id
            ]);
        }

        return redirect('/profile/' . $user->id);
    }

    public function unfollow(User $user)
    {

        Auth::user()->following()->where('following_to_id', $user->id)->delete();

        return redirect('/profile/' . $user->id);
    }

}
