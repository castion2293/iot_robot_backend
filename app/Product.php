<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guard = [];

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_product');
    }
}
