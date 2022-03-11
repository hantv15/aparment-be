<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'name' => $this->name,
            'dob' => $this->dob,
            'number_card' =>$this->number_card,
            'status' =>$this->status,
            'apartment_id' =>$this->apartment_id,
            'avatar' =>$this->avatar,
            'role_id' =>$this->role_id,
            'number_card' =>$this->device_key,
        ];
    }
}
