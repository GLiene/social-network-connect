<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $fillable = [
        'user_id', 'following_to_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Follower', 'user_id');
    }
}
