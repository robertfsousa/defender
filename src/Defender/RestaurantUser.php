<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantUser extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }
}
