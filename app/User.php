<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use App\Friend;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password', 'address', 'phone_number', 'birthday', 'bio', 'img_location'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $primaryKey = 'id';

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function following()
    {
        return $this->hasMany('App\Follower');
    }

    public function friends()
    {
        return $this->hasMany('App\Friend', 'user_id','friend_id');
    }

    public function friendOf()
    {
        return $this->belongsToMany("App\User","friends","friend_id","user_id");
    }

    public function pendingInvitations()
    {
        return $this->hasMany('App\PendingInvitation');
    }

    public function pendingInvitationsFromUsers()
    {
        return $this->belongsToMany("App\User","pending_invitations","pending_friend_id","user_id");
    }

    public function pendingFriends()
    {
        return DB::table('users')
            ->leftJoin('friends', 'users.id', '=', 'friends.user_id')
            ->where('approved', 0)
            ->get();
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function img_location(): string
    {
        return $this->img_location ? Storage::url($this->img_location, 'public') : asset("/default.jpg");
    }

    public function galleries()
    {
        return $this->hasMany('App\Gallery');
    }

}
