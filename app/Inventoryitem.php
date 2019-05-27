<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventoryitem extends Model
{
    protected $guarded = ['id'];

    public function character(){
        return $this->belongsTo('App\Character');
    }
}
