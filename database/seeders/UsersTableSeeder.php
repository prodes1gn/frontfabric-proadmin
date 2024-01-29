<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    public function run() {
        $users = [
            [
                'id' => 9,
                'order' => 1,
                'name' => 'SuperAdmin',
                'email' => '',
                'password' => '',
                'remember_token' => null,
                'approved' => 1,
                'verified' => 1,
                'verified_at' => '2022-12-29 00:11:13',
                'verification_token' => '',
                'two_factor_code' => '',
                'status' => 1,
                'superAdmin' => 1,
            ],
        ];

        User::insert($users);
    }

}
