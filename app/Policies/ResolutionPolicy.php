<?php

namespace App\Policies;

use App\Models\Resolution;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ResolutionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        if ($user->hasPermissionTo('View Posts')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Resolution $resolution)
    {
        if ($user->hasPermissionTo('View Posts')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        if ($user->hasPermissionTo('Create Posts')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Resolution $resolution)
    {
        if ($user->hasPermissionTo('Update Posts')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Resolution $resolution)
    {
        if ($user->hasPermissionTo('Delete Posts')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Resolution $resolution)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Resolution $resolution)
    {
        //
    }
}
