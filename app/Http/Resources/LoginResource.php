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
            'user_name'   => $this->user_name,
            'email' => $this->email,
            'name'  => $this->name,
            'dob' => $this->dob,
            'phone'  => $this->phone,
            'department_id'=>$this->department_id,
            'role'=>$this->role,
            'avatar'=>$this->avatar,
        ]
        ;
    }
}
