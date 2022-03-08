<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3',
//            'amount' => 'required|numeric|min:0',
//            'status' => 'required|integer|min:0|max:1',
//            'type_payment' => 'required|integer|min:0|max:1',
//            'payment_method' => 'required|integer|min:0|max:1',
            'image' => 'nullable|string',
            'fax' => 'nullable|string',
            'apartment_id' => 'required|integer|min:1',
            'receiver_id' => 'nullable|integer'
        ];
    }
}
