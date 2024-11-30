<?php

namespace App\Http\Requests\Main\Comment;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'text' => 'required|string|min:5|max:100',
        ];
    }

    public function messages()
    {
        return [
            'text.required' => 'Поле комментария должно быть заполнено',
            'text.min' => 'Минимун 5 символов',
            'text.max' => 'Максимум 100 символов',
        ];
    }
}
