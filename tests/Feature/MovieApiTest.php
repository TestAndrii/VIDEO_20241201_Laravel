<?php

namespace Tests\Feature;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovieApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_movies()
    {
        // Создать тестовые данные
        $genre = Genre::factory()->create();
        $movie = Movie::factory()->create();
        $movie->genres()->attach($genre->id); // Привязываем жанр к фильму

        // Выполнить GET-запрос
        $response = $this->get('/api/movies?per_page=10');

        // Проверить, что ответ успешный
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'is_published',
                    'poster_link',
                    'genres' => [
                        '*' => [
                            'id',
                            'name',
                        ],
                    ],
                ]
            ],
        ]);
    }

    public function test_can_get_single_movie()
    {
        // Создать тестовые данные
        $genre = Genre::factory()->create();
        $movie = Movie::factory()->create();
        $movie->genres()->attach($genre->id); // Привязываем жанр к фильму

        // Выполнить GET-запрос на получение конкретного фильма
        $response = $this->get('/api/movies/' . $movie->id);

        // Проверить, что ответ успешный
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'title',
            'is_published',
            'poster_link',
            'genres' => [
                '*' => [
                    'id',
                    'name',
                ],
            ],
        ]);
    }

    public function test_returns_404_for_nonexistent_movie()
    {
        // Выполнить GET-запрос на несуществующий фильм
        $response = $this->get('/api/movies/999'); // 999 — это несуществующий ID

        // Проверить, что мы получаем ответ 404
        $response->assertStatus(404);
    }
}
