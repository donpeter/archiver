<?php

namespace App\Policies;

use App\User;
use App\Document;
use Illuminate\Auth\Access\HandlesAuthorization;
use Carbon\Carbon;

class DocumentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the document.
     *
     * @param  \App\User  $user
     * @param  \App\Document  $document
     * @return mixed
     */
    public function update(User $user, Document $document)
    {
        if($document->created_at->diffInMinutes(Carbon::now()) > 5 ){
            return false;
        }else if ($user->isAdmin()) {
            return true;
        }else {
            return $user->id === $document->user_id;
        }
    }

    /**
     * Determine whether the user can delete the document.
     *
     * @param  \App\User  $user
     * @param  \App\Document  $document
     * @return mixed
     */
    public function delete(User $user, Document $document)
    {
        if($document->created_at->diffInMinutes(Carbon::now()) > 5 ){
            return false;
        }else if($user->isAdmin()) {
            return true;
        }else {
            return $user->id === $document->user_id;
        }

    }


    /**
     * Determine whether the user can delete the document.
     *
     * @param  \App\User  $user
     * @param  \App\Document  $document
     * @return mixed
     */
    public function restore(User $user, Document $document)
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
