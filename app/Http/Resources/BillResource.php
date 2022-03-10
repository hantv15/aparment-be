<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
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
            'name' => $this->name,
            'amount' => $this->amount,
            'status' => $this->status,
            'type_payment' => $this->type_payment,
            'payment_method' => $this->payment_method,
            'image' => $this->image,
            'fax' => $this->fax,
            'apartment_id' => $this->apartment_id,
            'notes' => $this->notes,
            'receiver_id' => $this->receiver_id,
        ];
    }
}
