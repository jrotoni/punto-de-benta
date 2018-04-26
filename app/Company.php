<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Sale;

class Company extends Model
{
    function categories() {
        return $this->hasMany('App\Category');
    }

    function products() {
        return $this->hasMany('App\Product');
    }

    function sales() {
        return $this->hasMany('App\Sale');
    }
    
    function users() {
        return $this->hasMany('App\User');
    }
}
