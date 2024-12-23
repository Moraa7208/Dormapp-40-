<?php

namespace App\Policies;

use App\Models\Assignment;
use App\Models\User;

class AssignmentPolicy
{
    /**
     * Create a new policy instance.
     */
    // public function __construct()
    // {
    //     //
    // }

    public function upload(User $user, Assignment $assignment)
    {
        return $user->id === $assignment->user_id;
    }
}
