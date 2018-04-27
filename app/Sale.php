<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Product;

class Sale extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function details() {
        return $this->hasMany('App\Sale_Detail');
    }

    public function product() {
        return $this->belongsTo('App\Product');
    }
}
