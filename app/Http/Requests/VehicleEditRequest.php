<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VehicleEditRequest extends FormRequest
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
            'plate_number' => [
                'required', 'string',
                Rule::unique('vehicles')->ignore($this->id),
                // 'regex:/[0-9]{2}-[A-Za-z][0-9]-[0-9]{4,5}/'
            ],
            'status'=>'required|integer|min:0|max:1'
        ];
    }
}
