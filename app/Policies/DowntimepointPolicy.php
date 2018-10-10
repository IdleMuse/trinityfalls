<?php

namespace App\Policies;

use App\User;
use App\Downtimepoint;
use Illuminate\Auth\Access\HandlesAuthorization;

class DowntimepointPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability){
        if($user->is_admin){
            return true;
        }
    }

    public function view(User $user, Downtimepoint $downtimepoint){
        return $user->can('view', $downtimepoint->downtime);
    }

    public function create(User $user){
        return $user->can('create', "App\Downtime");
    }

    public function update(User $user, Downtimepoint $downtimepoint){
        return $user->can('update', $downtimepoint->downtime);
    }

    public function delete(User $user, Downtimepoint $downtimepoint){
        return $user->is_admin;
    }
}
