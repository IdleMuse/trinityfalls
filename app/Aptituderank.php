<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aptituderank extends Model
{
    protected $guarded = ['id'];

    public function getNameAttribute(){
        return $this->aptitude->name." ".$this->rank;
    }

    public function aptitude(){
        return $this->belongsTo('App\Aptitude');
    }

    public function characters(){
        return $this->belongsToMany('App\Character')->withTimestamps();
    }

    public function getNextRanksAttribute(){
        $next = Aptituderank::where('aptitude_id', $this->aptitude_id)->where('rank', $this->rank + 1)->get();
        if($next->isEmpty()){
            return $this->aptitude->aptitudes->map(function($aptitude){
                return $aptitude->aptituderanks()->where('rank', 1)->first();
            });
        } else {
            return $next;
        }
    }
}
