<?php

namespace App\Imports;

use App\Models\Apartment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ApartmentsImport implements ToModel, WithHeadingRow
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
            'apartment_id' => $row['apartment_id'],
            'floor' => $row['floor'],
            'status' => $row['status'],
            'description' => $row['description'],
            'square_meters' => $row['square_meters'],
            'type_apartment' => $row['type_apartment'],
            'password' => $row['password'],
            'building_id' => $row['building_id'],
            'user_id' => $row['user_id'],
        ]);
    }
}