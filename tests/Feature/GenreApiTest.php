<?php
namespace Tests\Feature;

use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GenreApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_genres()
    {
        // Создаем несколько жанров для теста
        Genre::factory()->count(3)->create();

        // Отправляем GET-запрос на маршрут /api/genres
        $response = $this->get('/api/genres');

        // Проверяем, что ответ успешный
        $response->assertStatus(200);

        // Проверяем, что количество жанров в ответе соответствует количеству созданных
        $this->assertCount(3, $response->json());
    }

    public function test_can_get_movies_by_genre()
    {
        // Создаем жанр
        $genre = Genre::factory()->create();

        // Создаем 15 фильмов, связанных с жанром
        $genre->movies()->createMany([
            ['title' => 'Movie 1'],
            ['title' => 'Movie 2'],
            ['title' => 'Movie 3'],
            ['title' => 'Movie 4'],
            ['title' => 'Movie 5'],
            ['title' => 'Movie 6'],
            ['title' => 'Movie 7'],
            ['title' => 'Movie 8'],
            ['title' => 'Movie 9'],
            ['title' => 'Movie 10'],
            ['title' => 'Movie 11'],
            ['title' => 'Movie 12'],
            ['title' => 'Movie 13'],
            ['title' => 'Movie 14'],
            ['title' => 'Movie 15'],
        ]);

        // Отправляем GET-запрос на маршрут /api/genres/{id}?per_page=5
        $response = $this->get('/api/genres/' . $genre->id . '?per_page=5');

        // Проверяем, что ответ успешный
        $response->assertStatus(200);

        // Проверяем, что количество фильмов в ответе соответствует количеству на странице
        $this->assertCount(5, $response->json()['data']); // 'data' для JSON API Resource
    }

    public function test_can_return_404_when_genre_not_found()
    {
        // Отправляем GET-запрос на несуществующий жанр
        $response = $this->get('/api/genres/999');

        // Проверяем, что возвращается 404 статус
        $response->assertStatus(404);
        $response->assertJson(['message' => 'Genre not found']);
    }
}
