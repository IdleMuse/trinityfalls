<?php

namespace App\Policies;

use App\User;
use App\Skillrank;
use Illuminate\Auth\Access\HandlesAuthorization;

class SkillrankPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability){
        if($user->is_admin){
            return true;
        }
    }

    public function view(User $user, Skillrank $Skillrank){
        return $user->is_admin || !$Skillrank->is_hidden;
    }

    public function create(User $user){
        return $user->is_admin;
    }

    public function update(User $user, Skillrank $Skillrank){
        return $user->is_admin;
    }

    public function delete(User $user, Skillrank $Skillrank){
        return $user->is_admin;
    }
}
