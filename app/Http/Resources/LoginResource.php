<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return 
        [
            'token' => $this->token,
            'department_id' => $this->department_id,
            'floor' => $this->floor,
            'status' => $this->status,
            'description' => $this->description,
            'square_meters' => $this->square_meters,
            'type_department' => $this->type_department,
            'tower' => $this->tower,
            'user_id' => $this->user_id,
        ]
        ;
    }
}
