<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicles_default = [
            [
                'plate_number' => '29Z1-593.47',
                'vehicle_type_id' => 1,
                'apartment_id' => 1,
                'status' => 1,
            ],
            [
                'plate_number' => '75Y1-223.22',
                'vehicle_type_id' => 2,
                'apartment_id' => 2,
                'status' => 1,
            ],
            [
                'plate_number' => '11A1-111.22',
                'vehicle_type_id' => 1,
                'apartment_id' => 1,
                'status' => 1,
            ],
        ];

        DB::table('vehicles')->insert($vehicles_default);
    }
}
