<?php

namespace App\Http\Controllers;

use App\Follower;
use App\PendingInvitation;
use App\User;
use App\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{

    public function allFriendsAndPending()
    {
        $user = Auth::user();

        $idOfFriendsIAdded = Friend::where('user_id', $user->id)->pluck('friend_id')->toArray();
        $idOfFriendsAddedMe = Friend::where('friend_id', $user->id)->pluck('friend_id')->toArray();
        $idOfFriends = array_merge($idOfFriendsIAdded, $idOfFriendsAddedMe);

        $allFriends = User::find($idOfFriends);

        $sentInvitationFriendId = PendingInvitation::where('user_id', $user->id)->pluck('pending_friend_id')->toArray();
        $sentInvitationFriends = User::find($sentInvitationFriendId);

        $receivedInvitationFriendId = PendingInvitation::where('pending_friend_id', $user->id)->pluck('user_id')->toArray();
        $pendingFriends = User::find($receivedInvitationFriendId);

        return view('friendsAndPending.friends', ['allFriends' => $allFriends, 'pendingFriends' => $pendingFriends]);
    }

    public function deleteFriend(User $user)
    {

        Auth::user()->friends()->where('friend_id', $user->id)->delete();
        Auth::user()->following()->where('following_to_id', $user->id)->delete();

        return redirect('/profile/' . $user->id);
    }

    public function deleteFriendFromFriendsView(User $user)
    {

        Auth::user()->friends()->where('friend_id', $user->id)->delete();
        Auth::user()->following()->where('following_to_id', $user->id)->delete();

        return redirect('/friends');
    }
}
