<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{


    public function users()
    {
        return $this->belongsToMany('App\User', 'user_product');
    }

    public function customerSettings()
    {
        return $this->hasOne('App\ProductCustomerSetting');
    }
}
