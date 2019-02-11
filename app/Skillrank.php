<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skillrank extends Model
{
    protected $guarded = ['id'];

    public function skill(){
        return $this->belongsTo('App\Skill');
    }
}
