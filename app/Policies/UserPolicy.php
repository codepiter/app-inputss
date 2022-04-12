<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    /*public function __construct(User $user)
    {
        return $user->isAdmin();
    }*/

    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user, User $user_select)
    {
        return $user->isAdmin() && (($user_select->id == $user->id) || !$user_select->isAdmin());
    }

    public function updateState(User $user){
        return $user->isAdmin() && $user->status;
    }

    public function delete(User $user, User $user_select)
    {
        if ( $user->isAdmin() && (!$user_select->isAdmin() || ($user_select->id == $user->id))
        /*&& ($user_select->id != $user->id)*/ ) {
            return true;
        }
        return false;
    }
}
