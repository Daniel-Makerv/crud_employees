<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttachPermissionWithRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::all();

        foreach ($roles as $role) {

            if ($role->str === 'role-admin') {
                $permissions = Permission::pluck('id');
            } else {
                $permissions = Permission::whereIn('id', [1, 6])
                    ->pluck('id');
            }

            $role->permissions()->syncWithoutDetaching($permissions);
        }


        //assign role to users
        $users = User::get()->map(function ($user) {
            if ($user->email === 'admin@example.com') {
                $user->role_id = 1;
                $user->save();
            } else {
                $user->role_id = 2;
                $user->save();
            }
        });
    }
}
