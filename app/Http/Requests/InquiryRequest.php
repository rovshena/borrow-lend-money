<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InquiryRequest extends FormRequest
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
            'contact_name' => 'required|string|max:250',
            'contact_email' => 'email|max:250|nullable',
            'contact_phone' => 'string|max:15|nullable',
            'contact_content' => 'required|string|max:20000'
        ];
    }

    public function attributes()
    {
        return [
            'contact_name' => 'Имя',
            'contact_email' => 'Электронная почта',
            'contact_phone' => 'Телефон',
            'contact_content' => 'Письмо',
        ];
    }
}
