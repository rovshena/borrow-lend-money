<?php

namespace App\Http\Requests;

use App\Models\Announcement;
use Illuminate\Foundation\Http\FormRequest;

class AnnouncementRequest extends FormRequest
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
            'title' => 'required|string|max:250',
            'content' => 'required|string|min:20',
            'name' => 'required|string|max:250',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
        ];

        if ($this->announcement->type == Announcement::TYPE_LEND) {
            $rules = array_merge($rules, [
                'company' => 'required|string|max:250',
            ]);
        } else {
            $rules = array_merge($rules, [
                'company' => 'nullable|string|max:250',
            ]);
        }

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'title' => 'Заголовок',
            'content' => 'Условия займа и сроки возврата',
            'name' => 'Полное имя',
            'company' => 'Название компании',
            'email' => 'Электронная почта',
            'phone' => 'Телефон',
        ];
    }
}
