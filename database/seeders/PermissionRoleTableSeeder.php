<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::all();
        $user_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 11) != 'permission_';
        });
        Role::findOrFail(1)->permissions()->sync($user_permissions);
    }
}
