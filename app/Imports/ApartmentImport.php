<?php

namespace App\Imports;

use App\Models\Apartment;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ApartmentImport implements ToModel, WithStartRow
{
    const START_ROW = 6;
    const INACTIVE_STATUS = 'Active';
    const ACTIVE_STATUS = 'Inactive';
    const BULDING = [
        1 => 'Building 1',
        2 => 'Building 2',
        3 => 'Building 3',
        4 => 'Building 4',
        5 => 'Building 5',
        6 => 'Building 6',
    ];

    /**
     * @param array $row
     * @return Apartment
     */
    public function model(array $row): Apartment
    {
        return new Apartment([
            'apartment_id'   => $row[0],
            'floor'          => $row[1],
            'status'         => $this->getStatus($row[2]),
            'description'    => $row[3],
            'square_meters'  => $row[4],
            'type_apartment' => $row[5],
            'password'       => Hash::make($row[6]),
            'building_id'    => $this->getBuildingID($row[7]),
            'user_id'        => $row[8],
        ]);
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return self::START_ROW;
    }

    /**
     * @param $valueStatus
     * @return int
     */
    public function getStatus($valueStatus): int
    {
        if ($valueStatus == self::INACTIVE_STATUS) {
            return 0;
        }
        return 1;
    }

    /**
     * @param $valueBuilding
     * @return int|void
     */
    public function getBuildingID($valueBuilding)
    {
        foreach (self::BULDING as $key => $building) {
            if ($valueBuilding == $building) {
                return $key;
            }
        }
    }
}
