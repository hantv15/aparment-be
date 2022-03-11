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
        $requestRule = [
            'number'=>[
                'required','string',
                Rule::unique('cards')->ignore($this->id)
            ],
            'name' => 'required|string|min:3',
            'status'=>'required|integer|min:0|max:1',
            'apartment_id'=>'required|integer|min:0',
        ];

        return $requestRule;
    }
}
