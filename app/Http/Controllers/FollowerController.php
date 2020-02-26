<?php

namespace App\Http\Controllers;

use App\Follower;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function follow(Request $request, User $user)
    {
        if(Auth::user()->following()->where('following_to_id', $user->id)->value('following_to_id') !== $user->id)
        {
            $following = new Follower();
            $following->user_id = Auth::user()->id;
            $following->following_to_id = $user->id;
            $request->user()->following()->save($following);
        };

        return redirect('/profile/' . $user->id);
    }

    public function unfollow(User $user)
    {
 //       var_dump($user->id);die;
        $followingAll = Auth::user()->following()->get();


        foreach ($followingAll as $following){
            if($following->following_to_id === $user->id)
            {
                $following->delete();
            }
        }

        return redirect('/profile/' . $user->id);
    }

}
