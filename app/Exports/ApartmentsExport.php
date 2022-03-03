<?php

namespace App\Exports;

use App\Models\Apartment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ApartmentsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Apartment::all();
    }

    public function headings(): array
    {
        return [
            'apartment_id',
            'floor',
            'status',
            'description',
            'square_meters',
            'type_apartment',
            'password',
            'building_id',
            'user_id',
        ];
    }
}