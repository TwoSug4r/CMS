<?php

namespace App\Policies;

use App\Models\User;

class ManageUsersPolicy
{
    public function manageUsers(User $user)
    {
        return $user->hasRole('admin');
    }
}