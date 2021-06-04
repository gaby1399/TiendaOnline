<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo('App\Models\order');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
