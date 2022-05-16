<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicle_types_detault = [
            ['name' => 'Xe máy'],
            ['name' => 'Ô tô'],
            ['name' => 'Xe đạp/Xe đạp điện'],
        ];

        DB::table('vehicle_types')->insert($vehicle_types_detault);
    }
}
