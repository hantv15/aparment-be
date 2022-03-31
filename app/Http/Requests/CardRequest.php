<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
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
        $requestRule =  [
            'name' => [
                'required',
                Rule::unique('cards')->ignore($this->id)
            ],
            'status'=>'required|integer|min:0|max:1',
        'expire_time'=>'date_format:Y-m-d\TH:i',
        'apartment_id'=>'required|integer'
        ];
        
        

        return $requestRule;
    }
    public function messages()
    {
        return [
            'name.required'=> 'Tên số Không được trống',
            'name.string'=> 'Tên phải là chuỗi',
            'name.regex'=>'Tên không được chứa kí tự đặc biệt hoặc số',
            'status.required'=> 'Trạng thái Không được trống',
            'status.integer'=>'Trạng thái không đúng định dạng',
            'status.min'=> 'Trạng thái không được nhỏ hơn 0',
            'status.min'=> 'Trạng thái không được lớn hơn 1',
            'expire_time.date_format'=> 'Thời gian không hợp lệ',
            'apartment_id.required'=> 'Căn hộ này không được để trống',
            'apartment_id.integer'=> 'Căn hộ sai định dạng',
        ];
    }
}
