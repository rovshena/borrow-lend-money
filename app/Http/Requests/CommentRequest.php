<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    protected $errorBag = 'comment';
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
            'content' => 'required|string|min:5',
            'name' => 'nullable|string|max:250',
            'email' => 'nullable|email',
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
            'content' => 'Отзыв',
            'name' => 'Полное имя',
            'email' => 'Электронная почта'
        ];
    }
}
