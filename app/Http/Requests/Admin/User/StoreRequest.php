<?php

namespace App\Http\Requests\Admin\User;

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
            'name' => 'required|string',
            'email' => 'required|email|unique:App\Models\User,email',
            'password' => 'required|string|min:3',
            'role_id' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле должно быть заполнено',
            'email.required' => 'Поле должно быть заполнено',
            'email.unique' => 'Такая почта уже есть',
            'email.email' => 'Почта должна быть в формате mail@domain',
            'password.required' => 'Поле должно быть заполнено',
            'password.min' => 'Пароль должен быть не менее 3 символов',
        ];
    }
}
