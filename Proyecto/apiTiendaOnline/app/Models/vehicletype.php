<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicletype extends Model
{
    use HasFactory;

    public function trasnport()
    {
        return $this->hasMany('App\Models\trasnport');
    }
}
