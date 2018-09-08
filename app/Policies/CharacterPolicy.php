<?php

namespace App\Policies;

use App\User;
use App\Character;
use Illuminate\Auth\Access\HandlesAuthorization;

class CharacterPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Character $character){
        //
    }

    public function create(User $user){
        //
    }

    public function update(User $user, Character $character){
        //
    }

    public function delete(User $user, Character $character){
        //
    }
}
