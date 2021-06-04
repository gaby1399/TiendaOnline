<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transport extends Model
{
    use HasFactory;

    public function driver()
    {
        return $this->hasMany('App\Models\Driver');
    }
    public function vehicletype()
    {
        return $this->belongsTo('App\Models\vehicletype');
    }
}
