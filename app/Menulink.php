<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menulink extends Model
{
    protected $guarded = ['id'];

    public function getDisplayIconAttribute(){
        if(empty($this->icon)) return "external-link";
        else return $this->icon;
    }
}
