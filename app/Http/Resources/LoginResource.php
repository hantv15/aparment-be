<?php

namespace App\Http\Resources;

use App\Models\Building;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
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
                'token'         => $this->token,
                'email'         => $this->email,
                'phone_number'  => $this->phone_number,
                'name'          => $this->name,
                'dob'           => $this->dob,
                'number_card'   => $this->number_card,
                'status'        => $this->status,
                'department_id' => Department::where('id', $this->department_id)->first()->department_id,
                'building_id'   => Building::where('id', Department::where('id', $this->department_id)->first()->building_id)->first()->name,
                'avatar'        => $this->avatar,
                'role_id'       => $this->role_id,
            ];
    }
}
