<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function orderProducts()
    {
        return $this->hasMany('App\Models\OrderProduct');
    }

    public function bills()
    {
        return $this->hasMany('App\Models\Bill');
    }
    public function deliverytype()
    {
        return $this->belongsTo('App\Models\deliverytype');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'order_products', 'order_id', 'product_id')->withPivot('quantity', 'price')->withTimestamps();
    }
}
