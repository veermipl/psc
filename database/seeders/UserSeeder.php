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
        $adminuser = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@yopmail.com',
        ]);
        $adminuser->role()->sync(Role::where('name', 'Admin')->pluck('id')->toArray());
        $this->InitialUserRolePermission($adminuser);


        # create user of id(1)
        $user = User::factory()->create([
            'name' => 'JVweed',
            'email' => 'jvweed@yopmail.com',
        ]);
        $user->role()->sync(Role::where('name', 'User')->pluck('id')->toArray());
        $this->InitialUserRolePermission($user);

        #users
        User::factory(10)->create()->each(function ($user) {
            $role = Role::where('name', 'User')->pluck('id')->toArray();
            $user->role()->sync($role);

            $this->InitialUserRolePermission($user);
        });
    }
}
