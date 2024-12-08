<?php

namespace App\Policies;

use App\Models\User;
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

    public function viewAdminPanelLink(?User $user)
    {
//        admin = 0; reader = 1

        return $user?->role_id === 0;
    }

    public function admin(?User $user)
    {

        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }
}
