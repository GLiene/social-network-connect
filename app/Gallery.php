<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    Protected $fillable = [
        'user_id', 'title'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }
}
