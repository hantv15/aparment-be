<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cards_default = [
            [
                'number' => '100000000',
                'name' => 'Tài Duy',
                'status' => 1,
                'apartment_id' => 1,
            ],
            [
                'number' => '100000001',
                'name' => 'Đức Anh',
                'status' => 1,
                'apartment_id' => 2,
            ],
            [
                'number' => '100000002',
                'name' => 'Văn Huy',
                'status' => 1,
                'apartment_id' => 2,
            ],
            [
                'number' => '100000003',
                'name' => 'Thanh',
                'status' => 1,
                'apartment_id' => 3,
            ],
        ];

        DB::table('cards')->insert($cards_default);
    }
}
