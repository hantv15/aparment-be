<?php

namespace App\Http\Resources;

use App\Models\Building;
use App\Models\User;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $apartment_resource = [
            'apartment_id'   => $this->apartment_id,
            'floor'          => $this->floor,
            'status'         => $this->status,
            'description'    => $this->description,
            'square_meters'  => $this->square_meters,
            'type_apartment' => $this->type_apartment,
            'building_id'    => Building::where('id', $this->building_id)->first()->name,
        ];
        if ($this->user_id != null) {
            $apartment_resource['email'] = User::where('id', $this->user_id)->first()->email;
            $apartment_resource['phone_number'] = User::where('id', $this->user_id)->first()->phone_number;
            $apartment_resource['name'] = User::where('id', $this->user_id)->first()->name;
        }
        return $apartment_resource;
    }
}



