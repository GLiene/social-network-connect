<?php

namespace App\Http\Controllers;

use App\PendingInvitation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PendingInvitationController extends Controller
{
    public function inviteFriend(Request $request, User $user)
    {
        if (Auth::user()->pendingInvitations()->where('pending_friend_id', $user->id)->value('pending_friend_id') !== $user->id) {
            Auth::user()->pendingInvitations()->create([
                'pending_friend_id' => $user->id
            ]);

        }
        if (Auth::user()->following()->where('following_to_id', $user->id)->value('following_to_id') !== $user->id) {
            Auth::user()->following()->create([
                'following_to_id' => $user->id
            ]);
        }

        return redirect('/profile/' . $user->id);
    }

    public function approveFriend(User $user)
    {
        //need to be fixed
        PendingInvitation::where(["pending_friend_id" => Auth::user()->id], ["user_id" => $user->id])->delete();

        Auth::user()->friends()->create([
            'friend_id' => $user->id
        ]);

        return view('/friends');
    }

    public function deleteFriendRequest(User $user)
    {
        //need to be fixed
        Auth::user()->pendingInvitations()->where('pending_friend_id', $user->id)->delete();

        return view('/friends');
    }
}
