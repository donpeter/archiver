<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can update the organization.
     *
     * @param  \App\User  $user
     * @param  \App\Organization  $organization
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return $user->id === $model->id;
    }

    /**
     * Determine whether the user can delete the organization.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
       return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the folder.
     *
     * @param  \App\User  $user
     * @return Boolean
     */
    public function restore(User $user)
    {
        $user->isStaff();
    }
    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
}
