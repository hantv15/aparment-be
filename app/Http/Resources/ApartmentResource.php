<?php

namespace App\Http\Resources;

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
        return [
            'no_department'   => $this->no_department,
            'type_department' => $this->type_department,
            'status'          => $this->status,
            'description'     => $this->description,
            'square_meters'   => $this->square_meters,
        ];
    }
}
