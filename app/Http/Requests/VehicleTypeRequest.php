<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleTypeRequest extends FormRequest
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
            'name' => 'required|string|unique:vehicle_types|regex:/[A-Za-z]/',
        'price' => 'required|integer|min:1',
        ];
    }
    public function messages()
    {
        return [
        
        'name.required'=> 'Tên Không được trống',
        'name.string'=> 'Tên phải là chuỗi',
        'name.unique'=>'Tên đã tồn tại',
        'name.regex'=>'Tên không được chứa kí tự đặc biệt, số và phải là chữ',
        'price.required'=>'Phí không được trống',
        'price.integer'=>'Phí phải là số',
        'price.min'=>'Phí nhỏ nhất là 1'
        ];
    }
}
