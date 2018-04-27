<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    function sales() {
        return $this->hasMany('App\Sale_Detail');
    }
}
