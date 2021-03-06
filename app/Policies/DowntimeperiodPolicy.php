<?php

namespace App\Policies;

use App\User;
use App\Downtimeperiod;
use Illuminate\Auth\Access\HandlesAuthorization;

class DowntimeperiodPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability){
        if($user->is_admin){
            return true;
        }
    }

    public function view(User $user, Downtimeperiod $downtimeperiod){
        return $user->is_admin;
    }

    public function create(User $user){
        return $user->is_admin;
    }

    public function update(User $user, Downtimeperiod $downtimeperiod){
        return $user->is_admin;
    }

    public function delete(User $user, Downtimeperiod $downtimeperiod){
        return $user->is_admin;
    }
}
