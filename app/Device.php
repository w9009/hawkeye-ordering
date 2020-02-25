<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('product_amount');
    }

    public function orders() {
      return $this->belongsToMany('App\Order');
    }

    protected $fillable = [
        'name',
        'status',
        'image',
        'description',
    ];

    protected $hidden = [
        'id'
    ];
}
