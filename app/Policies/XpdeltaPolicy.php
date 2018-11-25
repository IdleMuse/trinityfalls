<?php

namespace App\Policies;

use App\User;
use App\Xpdelta;
use Illuminate\Auth\Access\HandlesAuthorization;

class XpdeltaPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability){
        if($user->is_admin){
            return true;
        }
    }

    public function view(User $user, Xpdelta $xpdelta){
        return $xpdelta->character->user->is($user);
    }

    public function create(User $user){
        return true;
    }

    public function update(User $user, Xpdelta $xpdelta){
        return $user->is_admin;
    }

    public function delete(User $user, Xpdelta $xpdelta){
        return $user->is_admin;
    }
}
