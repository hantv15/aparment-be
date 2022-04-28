<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillDetailRequest extends FormRequest
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
            'service_id' => 'required|integer|min:1',
            'quantity' => 'required|integer|min:0'
        ];
    }

    public function messages()
    {
        return [
            'service_id.required' => 'Vui lòng chọn dịch vụ',
            'quantity.required' => 'Vui lòng nhập số lượng',
            'quantity.integer' => 'Số lượng phải là số',
            'quantity.min' => 'Số lượng tối thiểu là 0',
        ];
    }
}
