<?php

namespace App\Http\Requests\Admin\Category;

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
            'title' => 'required|string|unique:App\Models\Category,title',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле должно быть заполнено',
            'title.unique' => 'Такая категория уже есть',
        ];
    }
}
