<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'description' => 'required|string|max:250',
            'status' => 'boolean|nullable',
        ];

        if ($this->setting->type == 'text') {
            $rules = array_merge($rules, [
                'value' => 'required|string|max:250',
            ]);
        }

        if ($this->setting->type == 'textarea' || $this->setting->type == 'editor' || $this->setting->type == 'code') {
            $rules = array_merge($rules, [
                'value' => 'required|string',
            ]);
        }

        if ($this->setting->type == 'file' && $this->setting->value === null) {
            $rules = array_merge($rules, [
                'image' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:15360'
            ]);
        }

        return $rules;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'status' => $this->boolean('status')
        ]);
    }

    public function attributes()
    {
        return [
            'description' => 'Описание',
            'status' => 'Статус',
            'value' => 'Значение',
            'image' => 'Изображение',
        ];
    }
}
