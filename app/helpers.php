<?php

use App\Traits\UserTraits;
use App\Traits\SettingTraits;
use App\Traits\NotificationTraits;

if (!function_exists('helper_getSettings')) {
    function helper_getSettings($param)
    {
        $settingTraitInstance = new class {
            use SettingTraits;
        };

        return $settingTraitInstance->getSettings($param);
    }
}

if (!function_exists('helper_getUnreadNotifications')) {
    function helper_getUnreadNotifications()
    {
        $notificationTraitInstance = new class {
            use NotificationTraits;
        };

        return $notificationTraitInstance->getUnreadNotifications();
    }
}

if (!function_exists('helper_getUserDetails')) {
    function helper_getUserDetails($param)
    {
        $userTraitInstance = new class {
            use UserTraits;
        };

        return $userTraitInstance->getUserDetails($param);
    }
}

if (!function_exists('helper_generateRandomPassword')) {
    function helper_generateRandomPassword()
    {
        $userTraitInstance = new class {
            use UserTraits;
        };

        return $userTraitInstance->generateRandomPassword();
    }
}
