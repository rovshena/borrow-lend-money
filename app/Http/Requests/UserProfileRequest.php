<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserProfileRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:250'
        ];

        if ($this->user()->username != 'administrator') {
            $rules = array_merge($rules, [
                'username' => [
                    'required', 'string', 'max:250', 'min:3',
                    Rule::unique('users', 'username')->ignore($this->user()->id)
                ],
            ]);
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => 'Полное имя',
            'username' => 'Имя пользователя',
        ];
    }
}
