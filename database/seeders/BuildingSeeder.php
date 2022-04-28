<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buildings_default = [
            ['name' => 'VP1'],
            ['name' => 'VP2'],
            ['name' => 'VP3'],
        ];

        DB::table('buildings')->insert($buildings_default);
    }
}
