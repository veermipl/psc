<?php

namespace App\Traits;

use App\Models\User;
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

    public function mailExist($mail = null, $role_id = null){
        $exists = true;

        if($mail){
            $exists = User::where('email', $mail)->exists();

            return $exists;
        }

        return $exists;
    }

    function generateRandomPassword($length = 12) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+-=';
        $charactersLength = strlen($characters);
        $randomPassword = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomPassword .= $characters[random_int(0, $charactersLength - 1)];
        }
    
        return $randomPassword;
    }
    
}
