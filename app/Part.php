<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    public function device()
    {
        return $this->hasOne('App\Device');
    }

    public function product()
    {
        return $this->hasOne('App\Product');
    }

    protected $fillable = [
        'product_id',
        'device_id',
        'amount',
        'id'
    ];
}
