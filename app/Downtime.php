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

    public function reorder($removed){
        $this->downtimepoints()->where("order", ">", $removed)->decrement('order');
    }
}
