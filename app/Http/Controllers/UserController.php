<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showUsersPosts(User $user)
    {
        $posts = $user->posts()->get()->sortByDesc('id');


        return view("/profile", ["user" => $user, "posts" => $posts]);
    }

    public function editForm()
    {
        $user = Auth::user();

        return view('/edit', compact('user'));
    }


    public function update(Request $request)
    {
        $user = Auth::user();

        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'address' => $request->address,
            'phone_number' => $request->phone,
            'birthday' => $request->birthday,
            'bio' => $request->bio,
            'updated_at' => now(),
        ]);

     //   return view('/profile', ['user' => $user]);
        //storage:link
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return;
    }
}
