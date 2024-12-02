<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Метод для получения всех жанров
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Загружаем все жанры
        $genres = Genre::all();

        // Возвращаем ответ в формате JSON
        return response()->json($genres);
    }

    /**
     * Метод для получения фильмов по жанру с пагинацией
     * @param $id
     * @param Request $request
     * @param $perPage
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id, Request $request, $perPage = 10)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json(['message' => 'Genre not found'], 404);
        }

        // Получаем фильмы жанра с пагинацией
        $movies = $genre->movies()->paginate($request->input('per_page', $perPage));

        return response()->json($movies); // Возвращаем фильмы жанра
    }
}
