<?php

namespace App\Imports;

use App\Models\Apartment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\ToModel;

class ApartmentsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // $current_date_time = Carbon::now()->toDateTimeString();
        return new Apartment([
            'apartment_id' => $row[1],
            // 'floor' => $row[2],
            // 'status' => $row[3],
            // 'description' => $row[4],
            // 'square_meters' => $row[5],
            // 'type_apartment' => $row[6],
            // 'password' => $row[7],
            // 'building_id' => $row[8],
            // 'user_id' => $row[9],
        ]);
    }
}