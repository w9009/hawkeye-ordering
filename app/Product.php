<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function devices()
    {
        return $this->belongsToMany('App\Device');
    }

    public function category()
    {
        return $this->hasOne('App\Category');
    }
    protected $fillable = [
        'name',
        'image',
        'price',
        'store',
        'amount',
        'delivery_time',
        'category_id',
    ];

    protected $hidden = [
        'id',
    ];
}
