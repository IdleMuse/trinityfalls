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

    }

    public function create(User $user){

    }

    public function update(User $user, Downtime $downtime){

    }

    public function delete(User $user, Downtime $downtime){
        
    }
}
