<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BorrowMoneyRequest extends FormRequest
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
            'state_id' => 'required|numeric|exists:states,id',
            'title' => 'required|string|max:250',
            'content' => 'nullable|string',
            'name' => 'required|string|max:250',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
        ];
    }

    public function messages()
    {
        return [
            'captcha.required' => 'Captcha is required',
            'captcha.captcha' => 'Invalid captcha code',
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
            'captcha' => 'Captcha',
        ];
    }
}
