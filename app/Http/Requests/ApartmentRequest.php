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
            'square_meters' => 'required|numeric|min:0',
            'type_apartment' => 'required|integer|min:0|max:1',
            'building_id' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'apartment_id.required' => 'Tên Không được trống',
            'apartment_id.string' => 'Tên phải là chuỗi',
            'apartment_id.unique' => 'Tên đã tồn tại',

            'floor.required' => 'Tầng không được trống ',
            'floor.integer' => 'Tầng phải là định dạn số',
            'floor.min' => 'Tầng không được nhỏ hơn 1',

            'status.required' => 'Trạng thái không được trống',
            'status.integer' => 'Trạng thái phải là số',
            'status.min' => 'Trạng thái là 0 hoặc 1',
            'status.max' => 'Trạng thái là 0 hoặc 1',

            'square_meters.required' => 'Diện tích không được để trống',
            'square_meters.numeric' => 'Diện tích phải là đinh dạng số',
            'square_meters.min' => 'Diện tích không được nhỏ hơn 1',

            'type_apartment.required' => 'Loại căn hộ không được trống',
            'type_apartment.integer' => 'Loại căn hộ phải là số',
            'type_apartment.min' => 'Loại căn hộ phải là 0 hoặc 1',
            'type_apartment.max' => 'Loại căn hộ phải là 0 hoặc 1',

            'building_id.required' => 'Tòa không được trống',
            'building_id.integer' => 'Tòa định dạng phải là số',
            'building_id.min' => 'Tòa nhỏ nhất là 1',
        ];
    }
}
