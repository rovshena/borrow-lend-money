<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LendMoneyRequest extends FormRequest
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
            'country_id' => 'required|numeric|exists:countries,id',
            'city_id' => 'required|numeric|exists:cities,id',
            'title' => 'required|string|max:250',
            'content' => 'required|string|min:20',
            'name' => 'required|string|max:250',
            'company' => 'required|string|max:250',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
        ];
    }

    public function messages()
    {
        return [
            'captcha.required' => 'Введите код с картинки',
            'captcha.captcha' => 'Неверный код с картинки',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'captcha' => 'Код с картинки',
            'country_id' => 'Страна',
            'city_id' => 'Город',
            'title' => 'Заголовок',
            'content' => 'Условия займа и сроки возврата',
            'name' => 'Полное имя',
            'company' => 'Название компании',
            'email' => 'Электронная почта',
            'phone' => 'Телефон',
        ];
    }
}
