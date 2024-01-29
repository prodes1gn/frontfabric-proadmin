<?php

namespace Database\Seeders;

use App\Models\RoleTranslation;
use Illuminate\Database\Seeder;

class RolesTranslationsTableSeeder extends Seeder {

    public function run() {
        $roles = [
            [
                'id' => 1,
                'locale' => 'bg',
                'role_id' => 1,
                'title' => 'Админ',
            ],
            [
                'id' => 2,
                'locale' => 'еn',
                'role_id' => 1,
                'title' => 'Admin',
            ],
        ];

        RoleTranslation::insert($roles);
    }

}
