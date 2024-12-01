<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
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
            // Поле 'title' обязательно, должно быть строкой, максимум 255 символов и уникальным среди фильмов.
            'title' => 'required|string|max:255|unique:movies,title',
            // Поле 'poster_link' может быть изображением с указанными форматами и максимальным размером 2 МБ.
            'poster_link' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // Поле 'genres' обязательно и должно быть массивом.
            'genres' => 'required|array',
            // Каждое значение в массиве 'genres' должно существовать в таблице 'genres' по 'id'.
            'genres.*' => 'exists:genres,id',
        ];
    }

    /**
     * Получает пользовательские сообщения об ошибках валидации.
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Название фильма обязательно для заполнения.',
            'title.unique' => 'Фильм с таким названием уже существует.',
            'poster_link.image' => 'Пожалуйста, загрузите корректное изображение.',
            'poster_link.mimes' => 'Допускаются только файлы форматов: jpeg, png, jpg, gif.',
            'genres.required' => 'Необходимо выбрать хотя бы один жанр.',
            'genres.array' => 'Жанры должны быть массивом.',
            'genres.*.exists' => 'Выбранный жанр не существует.',
        ];
    }
}
