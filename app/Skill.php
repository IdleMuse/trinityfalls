<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $guarded = ['id'];

    public function skillranks(){
        return $this->hasMany('App\Skillrank')->orderBy('rank');
    }
}
