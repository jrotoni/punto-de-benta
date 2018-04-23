<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    function categories() {
        return $this->hasMany('App\Category');
    }

    function products() {
        return $this->hasMany('App\Product');
    }
}
