<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CountryRequest extends FormRequest
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
            'status' => 'boolean|nullable',
        ];

        if ($this->isMethod('POST')) {
            $rules = array_merge($rules, [
                'iso3' => 'required|unique:countries,iso3|max:3',
                'iso2' => 'required|unique:countries,iso2|max:2',
                'slug' => 'required|unique:countries,slug|max:250'
            ]);
        }

        if ($this->isMethod('PUT')) {
            $rules = array_merge($rules, [
                'iso3' => [
                    'required', 'string', 'max:3',
                    Rule::unique('countries', 'iso3')->ignore($this->country),
                ],
                'iso2' => [
                    'required', 'string', 'max:2',
                    Rule::unique('countries', 'iso2')->ignore($this->country),
                ],
                'slug' => [
                    'required', 'string', 'max:250',
                    Rule::unique('countries', 'slug')->ignore($this->country),
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
            'name' => 'Название страны',
            'iso3' => 'ISO 3',
            'iso2' => 'ISO 2',
            'slug' => 'Slug',
            'status' => 'Статус',
        ];
    }
}
