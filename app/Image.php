<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    Protected $fillable = [
        'user_id', 'gallery_id', 'img_location'
    ];

    public function gallery()
    {
        return $this->belongsTo('App\Gallery', 'gallery_id');
    }
}
