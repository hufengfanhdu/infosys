<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $currentUser, User $user){
        return $currentUser->id === $user->id || in_array(Role::MANAGERS,Role::get_roles($currentUser));
    }

    public function user_destroy(User $currentUser, User $user){
        if ($currentUser->id === $user->id || in_array(Role::MANAGERS,Role::get_roles($user))){
            return false;
        }else{
            return true;
        }
    }

}
