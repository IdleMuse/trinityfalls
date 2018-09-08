<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['id'];
    protected $hidden = ['password', 'remember_token'];

    public function getIsAdminAttribute(){
        return $this->role == "admin";
    }

    public function characters(){
        return $this->hasMany("App\Character");
    }

    public function getActiveCharacterAttribute(){
        return $this->characters()->where('status','active')->first();
    }
}
