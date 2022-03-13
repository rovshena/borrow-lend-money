<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StateRequest extends FormRequest
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
            'name' => 'required|max:250',
            'country_id' => 'required|exists:countries,id'
        ];

        if ($this->isMethod('POST')) {
            $rules = array_merge($rules, [
                'iso_code' => 'required|unique:states,iso_code|max:10',
            ]);
        }

        if ($this->isMethod('PUT')) {
            $rules = array_merge($rules, [
                'iso_code' => [
                    'required', 'string', 'max:10',
                    Rule::unique('states', 'iso_code')->ignore($this->state),
                ],
            ]);
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => 'Название регион',
            'iso_code' => 'Код ISO',
            'country_id' => 'Страна',
        ];
    }
}
