<?php

namespace App\Policies;

use App\Models\Ads\Advertising;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdvertisingPolicy
{
    use HandlesAuthorization;

    /*public function before(User $user){
        return true;
    }*/

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Advertising  $advertising
     * @return mixed
     */
    public function view(User $user, Advertising $advertising)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Advertising  $advertising
     * @return mixed
     */
    public function update(User $user, Advertising $advertising)
    {
        //
        if($user->isAdmin() && $advertising->id != 1){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Advertising  $advertising
     * @return mixed
     */
    public function delete(User $user, Advertising $advertising)
    {
        //
        if($user->isAdmin() && $advertising->id != 1){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Advertising  $advertising
     * @return mixed
     */
    public function restore(User $user, Advertising $advertising)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Advertising  $advertising
     * @return mixed
     */
    public function forceDelete(User $user, Advertising $advertising)
    {
        //
    }
}
