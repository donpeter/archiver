<?php

namespace App\Policies;

use App\User;
use App\Organization;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrganizationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the organization.
     *
     * @param  \App\User  $user
     * @param  \App\Organization  $organization
     * @return mixed
     */
    public function update(User $user, Organization $organization)
    {
        return  $user->isStaff();
    }

    /**
     * Determine whether the user can delete the organization.
     *
     * @param  \App\User  $user
     * @param  \App\Organization  $organization
     * @return mixed
     */
    public function delete(User $user, Organization $organization)
    {
       return $user->isStaff();
    }

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
}
