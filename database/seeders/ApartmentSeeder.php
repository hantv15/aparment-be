<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments_detault = [
            [
                'apartment_id' => 'VP1-P101',
                'floor' => 1,
                'status' => 1,
                'square_meters' => 50,
                'type_apartment' => 0,
                'building_id' => 1
            ],
            [
                'apartment_id' => 'VP2-P101',
                'floor' => 1,
                'status' => 1,
                'square_meters' => 70,
                'type_apartment' => 0,
                'building_id' => 2
            ],
            [
                'apartment_id' => 'VP1-P201',
                'floor' => 2,
                'status' => 1,
                'square_meters' => 40,
                'type_apartment' => 0,
                'building_id' => 1
            ],
        ];

        DB::table('apartments')->insert($apartments_detault);
    }
}
