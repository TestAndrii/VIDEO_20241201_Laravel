<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGenreRequest extends FormRequest
{
    /**
     * Определяет, имеет ли пользователь право выполнять этот запрос.
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Разрешаем всем пользователям отправлять запрос
    }

    /**
     * Получает правила валидации для данного запроса.
     * @return array
     */
    public function rules(): array
    {
        return [
            // Имя жанра обязательно, строка, максимум 255 символов и должно быть уникальным в таблице genres
            'name' => 'required|string|max:255|unique:genres,name',
        ];
    }

    /**
     * Получает пользовательские сообщения об ошибках валидации.
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Имя жанра обязательно для заполнения.',
            'name.string' => 'Имя жанра должно быть строкой.',
            'name.max' => 'Имя жанра не должно превышать 255 символов.',
            'name.unique' => 'Имя жанра уже существует. Пожалуйста, выберите другое.',
        ];
    }
}
