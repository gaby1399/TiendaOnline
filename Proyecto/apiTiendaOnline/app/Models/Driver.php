<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    public function Bills()
    {
        return $this->hasMany('App\Models\Bill');
    }

    public function transport()
    {
        return $this->belongsTo('App\Models\transport');
    }
}
