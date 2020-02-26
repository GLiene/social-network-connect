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

    public function store(Request $request, User $user)
    {
        if(Auth::user()->followers()->where('following_to_id', $user->id)->value('following_to_id') !== $user->id)
        {
            $follower = new Follower();
            $follower->user_id = Auth::user()->id;
            $follower->following_to_id = $user->id;
            $request->user()->followers()->save($follower);
        };

        return redirect('/profile/' . $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Follower  $follower
     * @return \Illuminate\Http\Response
     */
    public function destroy(Follower $follower)
    {
        //
    }

}
