<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skillrank extends Model
{
    protected $guarded = ['id'];

    public function getNameAttribute(){
        return $this->skill->name." ".$this->rank;
    }

    public function skill(){
        return $this->belongsTo('App\Skill');
    }

    public function xpdeltas(){
        return $this->morphMany('App\Xpdelta', 'purchaseable');
    }
}
