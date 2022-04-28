<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_account = [
            [
                'email' => 'admin@gmail.com',
                'phone_number' => '0385241997',
                'password' => Hash::make('12345678'),
                'name' => 'Admin',
                'dob' => '2022-01-01',
                'number_card' => '013693258',
                'status' => 1,
                'role_id' => 1,
            ],
            [
                'email' => 'td.nguyen.1997@gmail.com',
                'phone_number' => '0399089824',
                'password' => Hash::make('12345678'),
                'name' => 'Tài Duy',
                'dob' => '1997-09-02',
                'number_card' => '001097027966',
                'status' => 1,
                'role_id' => 1,
            ],
            [
                'email' => 'anhndph12795@fpt.edu.vn',
                'phone_number' => '0813635868',
                'password' => Hash::make('12345678'),
                'name' => 'Đức Anh',
                'dob' => '1998-12-28',
                'number_card' => '001097027957',
                'status' => 1,
                'role_id' => 1,
            ],
        ];

        DB::table('users')->insert($admin_account);
    }
}
