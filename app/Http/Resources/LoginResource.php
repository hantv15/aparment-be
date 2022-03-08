<?php

namespace App\Http\Resources;

use App\Models\Apartment;
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
        $login_resource = [
            'token' => $this->token,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'name' => $this->name,
            'dob' => $this->dob,
            'number_card' => $this->number_card,
            'status' => $this->status,
            'avatar' => $this->avatar,
            'role_id' => $this->role_id
        ];
        if ($this->user_id != null) {
            $login_resource['apartment_id'] = Apartment::where('id', $this->apartment_id)->first()->apartment_id;
            $login_resource['building_id'] = Building::where('id', Apartment::where('id', $this->apartment_id)->first()->building_id)->first()->name;
        }
        return $login_resource;
    }
}
