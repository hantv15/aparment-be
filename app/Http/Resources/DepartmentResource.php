<?php

namespace App\Http\Resources;

use App\Models\Building;
use App\Models\User;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $department_resource = [
            'department_id'   => $this->department_id,
            'floor'           => $this->floor,
            'status'          => $this->status,
            'description'     => $this->description,
            'square_meters'   => $this->square_meters,
            'type_department' => $this->type_department,
            'building_id'     => Building::where('id', $this->building_id)->first()->name,
        ];
        if ($this->user_id != null){
            $department_resource['email'] = User::where('id', $this->user_id)->first()->email;
            $department_resource['phone_number'] = User::where('id', $this->user_id)->first()->phone_number;
            $department_resource['name'] = User::where('id', $this->user_id)->first()->name;
        }
        return $department_resource;

        // return [
        //     'department_id'   => $this->department_id,
        //     'floor'           => $this->floor,
        //     'status'          => $this->status,
        //     'description'     => $this->description,
        //     'square_meters'   => $this->square_meters,
        //     'type_department' => $this->type_department,
        //     'building_id'     => Building::where('id', $this->building_id)->first()->name,
        //     'email'           => User::select('email')->where('id', $this->user_id)->first(),
        //     'phone_number'    => User::select('phone_number')->where('id', $this->user_id)->first(),
        //     'name'            => User::select('name')->where('id', $this->user_id)->first(),
        // ];
    }
}
