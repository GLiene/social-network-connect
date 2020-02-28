<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    Protected $fillable = [
        'user_id', 'post'
    ];

    protected $casts = [
        'updated_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }
}
