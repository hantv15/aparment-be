<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
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
            'plate_number' => ['required',
            'string',
            // 'regex:/^(?!1|2|3|4|5|6|7|8|9|10|13|42|44|45|46|80)[0-9]{2}[a-zA-Z]{1}[1-9]?-?[0-9]{4,5}$/'
        ],
        'vehicle_type_id'=>'required|integer'
        ];
    }
    public function messages()
    {
        return [

            'plate_number.required'=> 'Biển số Không được trống',
            'plate_number.string'=> 'Biển số phải là chuỗi',
            // 'plate_number.regex'=>'Biển số không đúng',
            'vehicle_type_id.required'=>'Loại xe không được trống',
            'vehicle_type_id.integer'=> 'Loại xe không đúng định dạng'
        ];
    }
}
//^(?!29|30|31)[0-9]{2}[A-Z]{1}-[0-9]{4,5}$