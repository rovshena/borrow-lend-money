<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    private $customAttributes = [];

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
        $settings = Setting::where('key', 'like', $this->page . '%')->orderBy('created_at')->get();
        $rules = [];

        foreach ($settings as $setting) {
            if ($setting->type == 'text') {
                $rule = [
                    $setting->key => 'nullable|string|max:250',
                ];
            } elseif ($setting->type == 'textarea' || $setting->type == 'editor') {
                $rule = [
                    $setting->key => 'nullable|string',
                ];
            } else {
                $rule = [
                    $setting->key => 'nullable|string',
                ];
            }

            $rules = array_merge($rules, $rule);
            $this->customAttributes = array_merge($this->customAttributes, [
                $setting->key => $setting->description
            ]);
        }

        return $rules;
    }

    public function attributes()
    {
        return $this->customAttributes;
    }
}
