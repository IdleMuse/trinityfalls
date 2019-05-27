<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aptituderank extends Model
{
    protected $guarded = ['id'];

    public function aptitude(){
        return $this->belongsTo('App\Aptitude');
    }

    public function characters(){
        return $this->belongsToMany('App\Character');
    }
}
