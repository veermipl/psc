<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Traits\UserTraits;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Traits\NotificationTraits;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    use UserTraits, NotificationTraits;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        # create admin of id(1)
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@yopmail.com',
        ]);
        $admin->role()->sync(Role::where('name', 'Admin')->pluck('id')->toArray());
        $this->InitialUserRolePermission($admin);
        $this->logNotification('user_created', $admin);

        # create members of id(2)
        $member = User::factory()->create([
            'name' => 'Demo Member',
            'email' => 'demomember@yopmail.com',
        ]);
        $member->role()->sync(Role::where('name', 'Member')->pluck('id')->toArray());
        $this->InitialUserRolePermission($member);
        $this->logNotification('member_created', $member);

        #create members
        User::factory(5)->create()->each(function ($user) {
            $role = Role::where('name', 'Member')->pluck('id')->toArray();
            $user->role()->sync($role);

            $this->InitialUserRolePermission($user);
            $this->logNotification('member_created', $user);
        });
    }
}
