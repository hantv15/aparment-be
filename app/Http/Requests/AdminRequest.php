<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
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
            'name'=> 'required',
            'avatar'=>'image',
            'phone_number'=> [
                'required',
                Rule::unique('users')->ignore($this->id)
            ],
            'dob'=>'required',
            'number_card'=>[
                'required',
                Rule::unique('users')->ignore($this->id)
            ],
            'email'=>[
                'required', 'email',
                Rule::unique('users')->ignore($this->id)
            ],
        ];
        
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên Không được trống',
            'avatar'=>'Ảnh phải đúng định dạng',
            'phone_number.required' => 'Số điện thoại không được trống',
            'phone_number.unique' => 'Số điện đã tồn tại',
            'dob.required' => 'Ngày sinh Không được trống',
            'number_card.required'=>'Số CMND/CCCD không được rỗng',
            'number_card.unique'=>'Số CMND/CCCD đã tồn tại',
            'number_card.regex'=>'Số CMND/CCCD phải là số',
            'email.required' => 'Email không được trống',
            'email.email' => 'không đúng định dạng email',
            'email.unique' => 'Email đã tồn tại',
        ];
    }
}
