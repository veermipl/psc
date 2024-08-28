<?php

namespace App\Traits;

use App\Models\Notifications;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait NotificationTraits
{
    public function logNotification($type, $userData)
    {
        $gettypeInfo = $this->notificationTypeInfo($type, $userData);

        if(count($gettypeInfo) > 0){
            Notifications::create([
                'title' => $gettypeInfo['title'],
                'message' => $gettypeInfo['message'],
                'link' => $gettypeInfo['link'],
                'type' => $gettypeInfo['type'],
            ]);
        }

        return true;
    }

    public function notificationTypeInfo($type = null, $userData = [])
    {
        $info = [];

        if ($type == 'user_created') {
            $info['title'] = 'New User';
            $info['message'] = 'A new user has been created';
            $info['link'] = $userData ? route('admin.user.show', $userData['id']) : null;
            $info['type'] = 'user_created';
        }

        if ($type == 'member_created') {
            $info['title'] = 'New Member';
            $info['message'] = 'A new member has been created';
            $info['link'] = $userData ? route('admin.member.show', $userData['id']) : null;
            $info['type'] = 'member_created';
        }

        if ($type == 'member_registration') {
            $info['title'] = 'New Member';
            $info['message'] = 'New member registration';
            $info['link'] = $userData ? route('admin.member.show', $userData['id']) : null;
            $info['type'] = 'member_registration';
        }

        return $info;
    }
}
