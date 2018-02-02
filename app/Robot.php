<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Robot extends Model
{
    protected $guard = [];

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_robot');
    }
}
