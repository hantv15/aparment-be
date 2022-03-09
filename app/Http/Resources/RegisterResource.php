<?php

namespace App\Http\Resources;

use App\Models\Apartment;
use App\Models\Department;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return
            [   
                'id' => $this->id,
                'user_name'     => $this->user_name,
                'email'         => $this->email,
                'phone_number'  => $this->phone_number,
                'name'          => $this->name,
                'dob'           => $this->dob,
                'number_card'   => $this->number_card,
                'status'        => $this->status,
                'apartment_id' => Apartment::where('id', $this->apartment_id)->first(),
                'avatar'        => $this->avatar,
                'role_id'       => $this->role_id,
            ];
    }
}
