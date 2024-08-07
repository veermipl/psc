<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Traits\UserTraits;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    use UserTraits;

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

        # create user of id(2)
        $user = User::factory()->create([
            'name' => 'Demo User',
            'email' => 'demouser@yopmail.com',
        ]);
        $user->role()->sync(Role::where('name', 'User')->pluck('id')->toArray());
        $this->InitialUserRolePermission($user);

        # create members of id(3)
        $member = User::factory()->create([
            'name' => 'Demo Member',
            'email' => 'demomember@yopmail.com',
        ]);
        $member->role()->sync(Role::where('name', 'Member')->pluck('id')->toArray());
        $this->InitialUserRolePermission($member);

        #create members
        User::factory(10)->create()->each(function ($user) {
            $role = Role::where('name', 'Member')->pluck('id')->toArray();
            $user->role()->sync($role);

            $this->InitialUserRolePermission($user);
        });
    }
}
