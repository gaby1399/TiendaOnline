<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function orderProducts()
    {
        return $this->hasToMany('App\Models\OrderProduct');
    }

    public function classification()
    {
        return $this->belongsTo('App\Models\classification');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\order', 'order_products', 'product_id', 'order_id')->withPivot('quantity', 'price')->withTimestamps();
    }
}
