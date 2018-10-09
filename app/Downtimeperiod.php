<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Downtimeperiod extends Model
{
    protected $guarded = ['id'];

    public function downtimes(){
        return $this->hasMany('App\Downtime');
    }
}
