<?php

namespace Tests\Feature;

use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GenreTest extends TestCase
{
    use RefreshDatabase; // Обеспечивает сброс базы данных после каждого теста

    public function it_can_create_a_genre()
    {
        // Создаем жанр с помощью фабрики
        $genre = Genre::factory()->create();

        // Проверяем, что жанр был успешно создан в базе данных
        $this->assertDatabaseHas('genres', [
            'id' => $genre->id,
            'name' => $genre->name,
        ]);
    }


    public function it_can_list_genres()
    {
        // Создаем 5 жанров
        Genre::factory()->count(5)->create();

        // Выполняем GET-запрос к маршруту, который показывает список жанров
        $response = $this->get('/genres');

        // Проверяем, что запрос успешен и возвращает 200 статус
        $response->assertStatus(200);

        // Проверяем наличие жанров в ответе
        $response->assertViewHas('genres', function ($genres) {
            return $genres->count() === 5;
        });
    }


    public function it_can_update_a_genre()
    {
        // Создаем жанр
        $genre = Genre::factory()->create();

        // Обновляем название жанра
        $updatedName = 'New Genre Name';
        $response = $this->put('/genres/' . $genre->id, [
            'name' => $updatedName,
        ]);

        // Проверяем, что запрос успешен и возвращает 302 статус (редирект)
        $response->assertStatus(302);

        // Проверяем, что жанр был успешно обновлен в базе данных
        $this->assertDatabaseHas('genres', [
            'id' => $genre->id,
            'name' => $updatedName,
        ]);
    }


    public function it_can_delete_a_genre()
    {
        // Создаем жанр
        $genre = Genre::factory()->create();

        // Удаляем жанр
        $response = $this->delete('/genres/' . $genre->id);

        // Проверяем, что запрос успешен и возвращает 302 статус (Redirect)
        $response->assertStatus(302);

        // Проверяем, что жанр был успешно удален из базы данных
        $this->assertDatabaseMissing('genres', [
            'id' => $genre->id,
        ]);
    }
}
