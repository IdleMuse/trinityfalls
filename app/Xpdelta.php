<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Xpdelta extends Model
{
    protected $guarded = ['id'];

    public function character(){
        return $this->belongsTo('App\Character');
    }

    public function purchaseable(){
        return $this->morphTo('purchaseable');
    }
}
