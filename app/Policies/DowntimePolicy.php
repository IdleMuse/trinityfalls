<?php

namespace App\Policies;

use App\User;
use App\Downtime;
use Illuminate\Auth\Access\HandlesAuthorization;

class DowntimePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability){
        if($user->is_admin){
            return true;
        }
    }

    public function view(User $user, Downtime $downtime){
        return $downtime->character->user->is($user);
    }

    public function create(User $user){
        return true;
    }

    public function update(User $user, Downtime $downtime){
        return
            $downtime->downtimeperiod->is_open &&
            $downtime->character->user->is($user) &&
            $downtime->character->is_active;
    }

    public function delete(User $user, Downtime $downtime){
        return $user->is_admin;
    }
}
