<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenreRequest; // Импортируем класс для валидации создания
use App\Http\Requests\UpdateGenreRequest; // Импортируем класс для валидации обновления
use App\Models\Genre; // Импортируем модель Genre

class GenreController extends Controller
{
    /**
     * Возвращает список всех жанров с пагинацией.
     * @param int $perPage Кольичество жанров на странице.
     * @return \Illuminate\Contracts\View\View
     */
    public function index($perPage = 10): \Illuminate\Contracts\View\View
    {
        $genres = Genre::paginate($perPage); // Возвращаем коллекцию всех жанров с пагинацией
        return view('genre.index', compact('genres')); // Возвращаем представление с жанрами
    }

    /**
     * Показывает форму для создания нового жанра.
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): \Illuminate\Contracts\View\View
    {
        return view('genre.create'); // Возвращаем представление для создания жанра
    }

    /**
     * Сохраняет новый жанр в хранилище.
     * @param StoreGenreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreGenreRequest $request): \Illuminate\Http\RedirectResponse
    {
        Genre::create($request->validated()); // Создаем новый жанр
        return redirect()->route('genres.index')->with('success', 'Genre created successfully.'); // Перенаправляем на индекс с сообщением об успехе
    }

    /**
     * Показывает указанный жанр по ID.
     * @param string $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(string $id): \Illuminate\Contracts\View\View
    {
        $genre = Genre::findOrFail($id); // Находим жанр по ID
        return view('genre.show', compact('genre')); // Возвращаем представление с данными жанра
    }

    /**
     * Показывает форму для редактирования указанного жанра.
     * @param string $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(string $id): \Illuminate\Contracts\View\View
    {
        $genre = Genre::findOrFail($id); // Находим жанр по ID
        return view('genre.edit', compact('genre')); // Возвращаем представление для редактирования жанра
    }

    /**
     * Обновляет указанный жанр в хранилище.
     * @param UpdateGenreRequest $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateGenreRequest $request, string $id): \Illuminate\Http\RedirectResponse
    {
        $genre = Genre::findOrFail($id); // Находим жанр по ID
        $genre->update($request->validated()); // Обновляем жанр с использованием валидированных данных
        return redirect()->route('genres.index')->with('success', 'Genre updated successfully.'); // Перенаправляем на индекс с сообщением об успехе
    }

    /**
     * Удаляет указанный жанр из хранилища.
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id): \Illuminate\Http\RedirectResponse
    {
        $genre = Genre::findOrFail($id);  // Убедитесь, что жанр существует
        $genre->delete(); // Удаляем жанр
        return redirect()->route('genres.index')->with('success', 'Genre deleted successfully.'); // Перенаправляем на индекс с сообщением об успехе
    }
}
