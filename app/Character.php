<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo("App\User");
    }

    public function downtimes(){
        return $this->hasMany('App\Downtime');
    }

    public function getIsActiveAttribute(){
        return $this->status == "active";
    }

    public function getWordcountAttribute(){
        return $this->downtimes->reduce(function($carry, $dt){
            return $carry + $dt->wordcount;
        }, 0);
    }
}
