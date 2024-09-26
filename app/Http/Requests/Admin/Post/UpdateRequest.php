<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'required|string',
            'content' => 'required|string',
            'preview_image' => 'image|max:100',
            'main_image' => 'image',
            'category_id' => 'required|integer|exists:categories,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'nullable|integer|exists:tags,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле заголовка должно быть заполнено',
            'title.unique' => 'Такой заголовок уже есть',
            'content.required' => 'Поле текста должно быть заполнено',
            'preview_image.image' => 'Файл превью должен быть изображением (jpg, jpeg, png, bmp, gif, svg)',
            'preview_image.max' => 'Изображение превью не должно быть больше 100кб',
            'main_image.image' => 'Файл основной картинки должен быть изображением (jpg, jpeg, png, bmp, gif, svg)',
            'category_id.required' => 'Нужно выбрать категорию',
        ];
    }
}
