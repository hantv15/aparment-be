<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
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
            'department_id'   => $this->department_id,
            'floor'           => $this->floor,
            'status'          => $this->status,
            'description'     => $this->description,
            'square_meters'   => $this->square_meters,
            'type_department' => $this->type_department,
        ];
    }
}
