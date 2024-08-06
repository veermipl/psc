<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait UserTraits
{
    public function InitialUserRolePermission($user)
    {
        $user->load('role.permissions');
        $dbPermissions = $user->role->pluck('permissions')->collapse()->pluck('id')->unique()->toArray();
        $user->permissions()->sync($dbPermissions);

        return true;
    }
}
