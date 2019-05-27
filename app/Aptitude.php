<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aptitude extends Model
{
    protected $guarded = ['id'];

    // parent aptitude
    public function aptitude(){
        return $this->belongsTo('App\Aptitude');
    }

    // child aptitudes
    public function aptitudes(){
        return $this->hasMany('App\Aptitude');
    }

    public function aptituderanks(){
        return $this->hasMany('App\Aptituderank');
    }
}
