<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $users = [
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin@123'),
                'remember_token' => null,
                'created_at' => '2022-01-30 19:21:30',
                'updated_at' => '2022-01-30 19:21:30',
                'phone_number' => '123456789',
                'user_type' => 'Admin',
                'is_active' => '1',
            ]
        ];
        User::insert($users);
    }

}
