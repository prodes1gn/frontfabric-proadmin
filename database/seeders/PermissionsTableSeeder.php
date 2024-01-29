<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder {

    public function run() {
        $permissions = [
            [
                'id' => 7,
                'order' => 7,
                'title' => 'role_create',
            ],
            [
                'id' => 8,
                'order' => 8,
                'title' => 'role_edit',
            ],
            [
                'id' => 9,
                'order' => 9,
                'title' => 'role_show',
            ],
            [
                'id' => 10,
                'order' => 10,
                'title' => 'role_delete',
            ],
            [
                'id' => 11,
                'order' => 11,
                'title' => 'role_access',
            ],
            [
                'id' => 12,
                'order' => 12,
                'title' => 'user_create',
            ],
            [
                'id' => 13,
                'order' => 13,
                'title' => 'user_edit',
            ],
            [
                'id' => 14,
                'order' => 14,
                'title' => 'user_show',
            ],
            [
                'id' => 15,
                'order' => 15,
                'title' => 'user_delete',
            ],
            [
                'id' => 16,
                'order' => 16,
                'title' => 'user_access',
            ],
            [
                'id' => 17,
                'order' => 17,
                'title' => 'profile_password_edit',
            ],
            [
                'id' => 18,
                'order' => 18,
                'title' => 'filemanager_access',
            ],
            [
                'id' => 19,
                'order' => 19,
                'title' => 'translations_access',
            ],
            [
                'id' => 20,
                'order' => 20,
                'title' => 'settings_access',
            ],
        ];

        Permission::insert($permissions);
    }

}
