<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deliverytype extends Model
{
    use HasFactory;
    public function order()
    {
        return $this->hasMany('App\Models\order');
    }
}
