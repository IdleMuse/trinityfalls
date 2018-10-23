<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Downtime extends Model
{
    protected $guarded = ['id'];

    public function character(){
        return $this->belongsTo('App\Character');
    }

    public function downtimeperiod(){
        return $this->belongsTo('App\Downtimeperiod');
    }

    public function downtimepoints(){
        return $this->hasMany('App\Downtimepoint')->orderBy('order');
    }

    public function getResponsesCountAttribute(){
        return $this->downtimepoints()->whereNotNull('response')->count();
    }

    public function getWordcountAttribute(){
        return $this->downtimepoints->reduce(function($carry, $dtp){
            return $carry + $dtp->wordcount;
        }, 0);
    }

    public function getResponseWordcountAttribute(){
        return $this->downtimepoints->reduce(function($carry, $dtp){
            return $carry + $dtp->response_wordcount;
        }, 0);
    }

    public function reorder($removed){
        $this->downtimepoints()->where("order", ">", $removed)->decrement('order');
    }

    public static function allResponsesWordcount(){
        return Downtime::all()->reduce(function($carry, $dt){
            return $carry + $dt->response_wordcount;
        }, 0);
    }
}
