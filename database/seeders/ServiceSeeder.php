<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services_default = [
            [
                'name' => 'Tiền nước',
                'price' => 5973,
                'status' => 1
            ],
            [
                'name' => 'Tiền vé xe máy',
                'price' => 100000,
                'status' => 1
            ],
            [
                'name' => 'Tiền vé ô tô',
                'price' => 1500000,
                'status' => 1
            ],
        ];

        DB::table('services')->insert($services_default);
    }
}
