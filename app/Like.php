<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id', 'likeable_id', 'likeable_type'
    ];

 //   public function user(){
 //       $this->belongsTo('App\User');
  //  }

    public function likeable()
    {
        return $this->morphTo();
    }


}
