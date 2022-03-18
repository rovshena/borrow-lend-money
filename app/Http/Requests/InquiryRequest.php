<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InquiryRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

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
            'captcha' => 'bail|required|captcha',
            'contact_name' => 'required|string|max:250',
            'contact_email' => 'required|email:rfc,dns',
            'contact_phone' => 'string|max:15|nullable',
            'contact_content' => 'required|string|max:20000'
        ];
    }

    public function messages()
    {
        return [
            'captcha.required' => 'Введите код с картинки',
            'captcha.captcha' => 'Неверный код с картинки',
        ];
    }

    public function attributes()
    {
        return [
            'captcha' => 'Код с картинки',
            'contact_name' => 'Полное имя',
            'contact_email' => 'Электронная почта',
            'contact_phone' => 'Телефон',
            'contact_content' => 'Сообщение',
        ];
    }
}
