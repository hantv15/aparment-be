<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApartmentRequest extends FormRequest
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
            'apartment_id' => [
                'required', 'string',
                Rule::unique('apartments')->ignore($this->id)
            ],
            'floor' => 'required|integer|min:1',
            'status' => 'required|integer|min:0|max:1',
            'square_meters' => 'nullable|numeric|min:0',
            'type_apartment' => 'required|integer|min:0|max:1',
            'building_id' => 'required|integer|min:1',
            'user_id' => 'nullable|integer|min:1'
        ];
    }
}
