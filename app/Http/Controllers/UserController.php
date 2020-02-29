<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showUsersPosts(User $user)
    {
        $posts = $user->posts()->get()->sortByDesc('id');
        $allGalleries = Gallery::where(['user_id' => Auth::user()->id])->get();

        return view("/profile", ["user" => $user, "posts" => $posts, "allGalleries" => $allGalleries]);
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
        return back();

    }

    public function profilePictureUpload(Request $request)
    {
        if (request()->hasFile("image")) {
            $user = Auth::user();
            $user->update([
                "img_location" => request()->image->store("img", "public"),
            ]);
        }

        return back()->with('message', 'Profile Picture Uploaded');
    }
}
