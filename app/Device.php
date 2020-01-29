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
        return $this->belongsToMany('App\Product');
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


