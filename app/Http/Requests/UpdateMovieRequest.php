<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieRequest extends FormRequest
{
    /**
     * Определяет, имеет ли пользователь право выполнять этот запрос.
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Разрешаем всем пользователям отправлять этот запрос
    }

    /**
     * Получает правила валидации для данного запроса.
     * @return array
     */
    public function rules(): array
    {
        return [
            // Поле 'title' обязательно, должно быть строкой и максимум 255 символов.
            // Также добавляем проверку уникальности, исключая текущий фильм (по id).
            'title' => 'required|string|max:255',

            // Поле 'poster_link' проверяется на наличие изображения с указанными форматами и максимальным размером 2 МБ.
            'poster_link' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',

            // Поле 'genres' обязательно, должно быть массивом.
            'genres' => 'required|array',

            // Каждое значение в массиве 'genres' должно существовать в таблице 'genres' по 'id'.
            'genres.*' => 'exists:genres,id',
        ];
    }

    /**
     * Непосредственно задаёт пользовательские сообщения об ошибках валидации.
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Названия фильма обязательно.',
            'title.unique' => 'Фильм с этим названием уже существует.',
            'poster_link.image' => 'Пожалуйста, загрузите действительное изображение.',
            'poster_link.mimes' => 'Разрешены только файлы формата: jpeg, png, jpg, gif.',
            'genres.required' => 'Необходимо выбрать хотя бы один жанр.',
            'genres.exists' => 'Некоторые из выбранных жанров не существуют.',
        ];
    }
}
