<?php

namespace App\Policies;

use App\Models\Ordinance;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OrdinancePolicy
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
    public function view(User $user, Ordinance $ordinance)
    {
        // return $user->hasRole(['Admin', 'Writer', 'Moderator']);
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
        // if ($user->hasRole(['Admin', 'Writer', 'Moderator']) || $user->hasPermissionTo('Create Posts')){
        //     return true;
        // }
        // return false;
        if ($user->hasPermissionTo('Create Posts')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Ordinance $ordinance)
    {
        // return $user->hasRole(['Admin', 'Moderator']);
        if ($user->hasPermissionTo('Update Posts')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ordinance $ordinance)
    {
        // return $user->hasRole(['Admin', 'Moderator']);
        if ($user->hasPermissionTo('Delete Posts')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Ordinance $ordinance)
    {
        
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Ordinance $ordinance)
    {
        
    }
}
