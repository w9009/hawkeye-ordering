<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function devices() {
      return $this->belongsToMany('App\Device')->withPivot('quantity');
    }

    public function users() {
      return $this->belongsToMany('App\user');
    }

    public function status() {
        return $this->belongsTo('App\Status');
    }

    protected $fillable = [
      'title',
      'due',
    ];
}
