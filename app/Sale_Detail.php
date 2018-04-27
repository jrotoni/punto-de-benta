<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Sale_Detail extends Model
{
    public function product() {
        return $this->belongsTo('App\Product');
    }
}
