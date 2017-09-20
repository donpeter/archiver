<?php

namespace App\Policies;

use App\User;
use App\Folder;
use Illuminate\Auth\Access\HandlesAuthorization;

class FolderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the folder.
     *
     * @param  \App\User  $user
     * @param  \App\Folder  $folder
     * @return Boolean
     */
    public function update(User $user, Folder $folder)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the folder.
     *
     * @param  \App\User  $user
     * @param  \App\Folder  $folder
     * @return Boolean
     */
    public function delete(User $user, Folder $folder)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the folder.
     *
     * @param  \App\User  $user
     * @param  \App\Folder  $folder
     * @return Boolean
     */
    public function restore(User $user, Folder $folder)
    {
        if ($user->isStaff()) {
            return true;
        }else {
            return $user->id === $document->user_id;
        }
    }

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
}
