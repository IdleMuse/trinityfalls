<?php

namespace App\Policies;

use App\User;
use App\Aptituderank;
use Illuminate\Auth\Access\HandlesAuthorization;

class AptituderankPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability){
        if($user->is_admin){
            return true;
        }
    }

    public function view(User $user, Aptituderank $aptituderank){
        return $user->is_admin || empty($aptituderank->aptitude->aptitude);
    }

    public function create(User $user){
        return $user->is_admin;
    }

    public function update(User $user, Aptituderank $aptituderank){
        return $user->is_admin;
    }

    public function delete(User $user, Aptituderank $aptituderank){
        return $user->is_admin;
    }
}
