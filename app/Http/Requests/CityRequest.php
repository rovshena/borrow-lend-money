<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CityRequest extends FormRequest
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
            'country_id' => 'required|exists:countries,id',
            'status' => 'boolean|nullable',
            'oblast' => 'nullable|string',
            'region' => 'nullable|string',
        ];

        if ($this->isMethod('POST')) {
            $rules = array_merge($rules, [
                'name' => 'required|string|unique:cities,name|max:250',
                'slug' => 'required|unique:cities,slug|max:250',
            ]);
        }

        if ($this->isMethod('PUT')) {
            $rules = array_merge($rules, [
                'name' => [
                    'required', 'string', 'max:250',
                    Rule::unique('cities', 'name')->ignore($this->city),
                ],
                'slug' => [
                    'required', 'string', 'max:250',
                    Rule::unique('cities', 'slug')->ignore($this->city),
                ],
            ]);
        }

        return $rules;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'status' => $this->isMethod('POST') ? true : $this->boolean('status')
        ]);
    }

    public function attributes()
    {
        return [
            'name' => 'Название города',
            'status' => 'Статус',
            'country_id' => 'Страна',
            'slug' => 'Slug',
            'oblast' => 'Область',
            'region' => 'Регион',
        ];
    }
}
