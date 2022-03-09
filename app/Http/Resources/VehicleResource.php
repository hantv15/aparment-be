<?php

namespace App\Http\Resources;

use App\Models\Card;
use App\Models\VehicleType;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'plate_number' => $this->plate_number,
            'vehicle_type_id' => VehicleType::where('id', $this->vehicle_type_id)->first()->name,
            'card_id' => Card::where('id', $this->card_id)->first()->number,
            'status' => $this->status,
            'image' => $this->image,
        ];
    }
}
