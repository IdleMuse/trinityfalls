<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Downtimeperiod extends Model
{
    protected $guarded = ['id'];
    protected $dates = [
        "created_at",
        "updated_at",
        "opens_at",
        "closes_at",
        "releases_at"
    ];

    public function downtimes(){
        return $this->hasMany('App\Downtime');
    }

    public function getIsOpenAttribute(){
        $now = Carbon::now();
        return $now->gt($this->opens_at) && $now->lt($this->closes_at);
    }

    public function getIsReleasedAttribute(){
        $now = Carbon::now();
        return $now->gt($this->releases_at);
    }
}
