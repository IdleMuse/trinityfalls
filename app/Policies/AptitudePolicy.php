<?php

namespace App\Policies;

use App\User;
use App\Aptitude;
use Illuminate\Auth\Access\HandlesAuthorization;

class AptitudePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability){
        if($user->is_admin){
            return true;
        }
    }

    public function view(User $user, Aptitude $aptitude){
        return $user->is_admin || empty($aptitude->aptitude);
    }

    public function create(User $user){
        return $user->is_admin;
    }

    public function update(User $user, Aptitude $aptitude){
        return $user->is_admin;
    }

    public function delete(User $user, Aptitude $aptitude){
        return $user->is_admin;
    }
}
