<?php

namespace App\Policies;

use App\User;
use App\Skill;
use Illuminate\Auth\Access\HandlesAuthorization;

class SkillPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability){
        if($user->is_admin){
            return true;
        }
    }

    public function view(User $user, Skill $Skill){
        return true;
    }

    public function create(User $user){
        return $user->is_admin;
    }

    public function update(User $user, Skill $Skill){
        return $user->is_admin;
    }

    public function delete(User $user, Skill $Skill){
        return $user->is_admin;
    }
}
