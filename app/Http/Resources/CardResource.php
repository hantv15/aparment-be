<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
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
            'id'=>$this->id,
            'number' => $this->number,
            'name'=>$this->name,
            'status' => $this->status,
            'expire_time' => $this->expire_time,
            'apartment_id' => $this->apartment_id,
        ];
    }
}
