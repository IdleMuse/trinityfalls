<?php

namespace App\Policies;

use App\User;
use App\Menulink;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenulinkPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability){
        if($user->is_admin){
            return true;
        }
    }

    public function view(User $user, Menulink $menulink){
        return true;
    }

    public function create(User $user){
        return $user->is_admin;
    }

    public function update(User $user, Menulink $menulink){
        return $user->is_admin;
    }

    public function delete(User $user, Menulink $menulink){
        return $user->is_admin;
    }
}
