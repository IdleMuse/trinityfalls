<?php

namespace App\Policies;

use App\User;
use App\Character;
use Illuminate\Auth\Access\HandlesAuthorization;

class CharacterPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability){
        if($user->is_admin){
            return true;
        }
    }

    public function view(User $user, Character $character){
        return $character->user->is($user);
    }

    public function create(User $user){
        return $user->characters()->where('status','active')->count() == 0;
    }

    public function update(User $user, Character $character){
        return $character->user->is($user);
    }

    public function delete(User $user, Character $character){
        return false;
    }
}
