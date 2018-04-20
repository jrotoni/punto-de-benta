<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    function user() {
        return $this->belongsTo('App\User', 'company_id', 'id');
    }
}
