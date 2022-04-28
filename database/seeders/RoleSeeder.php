<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles_default = [
            ['name' => 'Admin'],
            ['name' => 'Nhân viên'],
            ['name' => 'Người dùng'],
        ];

        DB::table('roles')->insert($roles_default);
    }
}
