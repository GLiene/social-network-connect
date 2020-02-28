<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendingInvitation extends Model
{
    protected $fillable = [
        'user_id', 'pending_friend_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
