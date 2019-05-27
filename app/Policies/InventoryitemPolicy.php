<?php

namespace App\Policies;

use App\User;
use App\Inventoryitem;
use Illuminate\Auth\Access\HandlesAuthorization;

class InventoryitemPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability){
        if($user->is_admin){
            return true;
        }
    }

    public function view(User $user, Inventoryitem $inventoryitem){
        return true;
    }

    public function create(User $user){
        return $user->is_admin;
    }

    public function update(User $user, Inventoryitem $inventoryitem){
        return $user->is($inventoryitem->character->user);
    }

    public function delete(User $user, Inventoryitem $inventoryitem){
        return $user->is_admin;
    }
}
