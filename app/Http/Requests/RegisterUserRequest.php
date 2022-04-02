<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email'        => 'required|email|unique:users',
            'phone_number' => 'required|unique:users',
            'apartment_id' => 'required|unique:users',
            'dob'          => 'required|date_format:Y-m-d|before:' . Carbon::now(),
            'name'         => 'required',
            'number_card'  => 'required',
            'avatar'       => 'mimes:png, jpg, jpeg',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'email.required'        => ':attribute không được để trống',
            'email.email'           => ':attribute không đúng định dạng',
            'email.unique'          => ':attribute đã tồn tại',
            'phone_number.required' => ':attribute không được để trống',
            'phone_number.unique'   => ':attribute đã tồn tại',
            'apartment_id.required' => 'Phòng không được để trống',
            'apartment_id.unique'   => 'Phòng đã có người đăng ký',
            'dob.required'          => ':attribute không được để trống',
            'dob.date_format'       => ':attribute phải là định dạng đúng định dạng (Năm-tháng-ngày)',
            'dob.before'            => ':attribute không được là tương lai',
            'number_card.required'  => ':attribute không được để trống',
            'avatar.mimes'          => ':attribute phải đúng định dạng JPG, JPEG, PNG',
            'name.required'         => ':attribute không được để trống',
            'name.regex'            => ':attribute không được chứa kí tự số và kí tự đặc biệt',
            'phone_number.regex'    => ':attribute không đúng định dạng',
        ];
    }

    /**
     * @return string[]
     */
    public function attributes(): array
    {
        return [
            'name'         => 'Họ và tên',
            'email'        => 'Địa chỉ Email',
            'phone_number' => 'Số điện thoại',
            'dob'          => 'Ngày sinh',
            'number_card'  => 'Số CMND/CCCD',
            'avatar'       => 'Hình ảnh đại diện',
        ];
    }
}
