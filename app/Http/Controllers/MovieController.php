<?php
namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Http\Requests\StoreMovieRequest; // Импортируем класс StoreMovieRequest для валидации создания
use App\Http\Requests\UpdateMovieRequest; // Импортируем класс UpdateMovieRequest для валидации обновления

class MovieController extends Controller
{
    /**
     * Показать список всех фильмов с пагинацией.
     * @param int $perPage Количество фильмов на странице.
     * @return \Illuminate\View\View
     */
    public function index($perPage = 10): \Illuminate\View\View
    {
        // Получаем список фильмов с пагинацией
        $movies = Movie::paginate($perPage);

        // Возвращаем представление с фильмами
        return view('movie.index', compact('movies'));
    }

    /**
     * Показать форму для добавления нового фильма.
     * @return \Illuminate\View\View
     */
    public function create(): \Illuminate\View\View
    {
        $genres = Genre::all(); // Получаем все жанры из базы данных
        return view('movie.create', compact('genres')); // Передаем жанры в представление
    }

    /**
     * Сохранить новый фильм в базе данных.
     * @param StoreMovieRequest $request Входные данные для создания.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreMovieRequest $request): \Illuminate\Http\RedirectResponse
    {
        // Получаем валидированные данные
        $data = $request->validated();
        $data['is_published'] = false; // По умолчанию фильм не опубликован

        // Передаем запрос в метод, чтобы обработать загрузку изображения
        $data['poster_link'] = $this->handleImageUpload($request);

        // Создаем новый фильм с валидированными данными
        Movie::create($data);

        // Перенаправляем на страницу списка фильмов с сообщением об успешном добавлении
        return redirect()->route('movies.index')->with('success', 'Фильм успешно добавлен!');
    }

    /**
     * Логика загрузки изображения
     * @param \Illuminate\Http\Request $request
     * @return string Путь к загруженному изображению или путь к дефолтному изображению
     */
    protected function handleImageUpload($request): string
    {
        // Проверяем, был ли загружен файл
        if ($request->hasFile('poster')) {
            // Создаем уникальное имя для изображения с помощью времени и оригинального расширения файла
            $imageName = time() . '.' . $request->file('poster')->getClientOriginalExtension();

            // Сохраняем изображение в директории public/posters
            $request->file('poster')->storeAs('posters', $imageName, 'public');

            // Возвращаем путь к загруженному изображению
            return '/storage/posters/' . $imageName;
        }

        // Если файл не загружен, возвращаем путь к дефолтному изображению
        return '/images/default.jpg';
    }

    /**
     * Показать конкретный фильм.
     * @param int $id ID фильма.
     * @return \Illuminate\View\View
     */
    public function show($id): \Illuminate\View\View
    {
        // Находим фильм по ID
        $movie = Movie::findOrFail($id);

        // Возвращаем представление с фильмом
        return view('movie.show', compact('movie'));
    }

    /**
     * Показать форму для редактирования фильма.
     * @param int $id ID фильма.
     * @return \Illuminate\View\View
     */
    public function edit($id): \Illuminate\View\View
    {
        $genres = Genre::all(); // Получаем все жанры из базы данных
        // Находим фильм по ID
        $movie = Movie::findOrFail($id);

        // Возвращаем представление для редактирования фильма
        return view('movie.edit', compact('movie', 'genres'));
    }

    /**
     * Обновить существующий фильм в базе данных.
     * @param UpdateMovieRequest $request Входные данные для обновления.
     * @param int $id ID фильма.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        // Обновляем название видео
        $movie->title = $request->title;

        // Обработка загрузки файла постера
        if ($request->hasFile('poster_link')) {
            // Сохраняем новый файл на сервере и получаем его путь
            $path = $request->file('poster_link')->store('posters', 'public');

            $movie->poster_link = $path;
        }

        // Обновление жанров
        $movie->genres()->sync($request->genres);
        $movie->save();

        return redirect()->route('movies.index')->with('success', 'Фильм обновлен успешно');
    }

    /**
     * Удалить фильм из базы данных.
     * @param int $id ID фильма.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        // Находим фильм по ID и удаляем его
        $movie = Movie::findOrFail($id);
        $movie->delete();

        // Перенаправляем на страницу списка фильмов с сообщением об успешном удалении
        return redirect()->route('movies.index')->with('success', 'Фильм успешно удален!');
    }

    /**
     * Публикация фильма
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publish($id)
    {
        // Находим фильм по его ID
        $movie = Movie::findOrFail($id);

        // Меняем статус на противоположный
        $movie->is_published = !$movie->is_published;
        $movie->save();

        return redirect()->route('movies.index')->with('success', 'Статус фильма изменён успешно.');
    }
}
