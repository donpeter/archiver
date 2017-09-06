<?php

namespace App\Policies;

use App\User;
use App\File;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can delete the file.
     *
     * @param  \App\User  $user
     * @param  \App\File  $file
     * @return mixed
     */
    public function delete(User $user, File $file)
    {
       return $user->id === $file->user_id;
    }

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
}
