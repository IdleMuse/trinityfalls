<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Downtimepoint extends Model
{
    protected $guarded = ['id'];

    public function downtime(){
        return $this->belongsTo('App\Downtime');
    }
}
