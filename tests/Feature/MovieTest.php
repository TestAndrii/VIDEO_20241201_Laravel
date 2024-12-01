<?php
namespace Tests\Feature;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovieTest extends TestCase
{
    use RefreshDatabase;

    /**
    * Тест показ списка фильмов.
    */
    public function test_index()
    {
        $response = $this->get(route('movies.index'));
        $response->assertStatus(200); // Проверка, что статус ответа 200
        $response->assertViewIs('movie.index'); // Проверка правильного представления
    }

    /**
    * Тест показа формы создания фильма.
    */
    public function test_create()
    {
        $response = $this->get(route('movies.create'));
        $response->assertStatus(200);
        $response->assertViewIs('movie.create');
    }

    /**
    * Тест добавления нового фильма.
    */
    public function test_store()
    {
        // Предполагаем, что есть хотя бы один жанр в базе данных
        $genre = Genre::factory()->create();

        $data = [
            'title' => 'Test Movie',
            'description' => 'Test description',
            'poster' => null,
            'genres' => [$genre->id], // Добавляем ID жанра
        ];

        $response = $this->post(route('movies.store'), $data);

        $response->assertRedirect(route('movies.index'));
        $this->assertDatabaseHas('movies', [
            'title' => 'Test Movie',
        ]);
    }

    /**
    * Тест показа конкретного фильма.
    */
    public function test_show()
    {
        $movie = Movie::factory()->create();
        $response = $this->get(route('movies.show', $movie));
        $response->assertStatus(200);
        $response->assertViewIs('movie.show');
    }

    /**
    * Тест показа формы редактирования фильма.
    */
    public function test_edit()
    {
        $movie = Movie::factory()->create();
        $response = $this->get(route('movies.edit', $movie));
        $response->assertStatus(200);
        $response->assertViewIs('movie.edit');
    }

    /**
    * Тест обновления фильма.
    */
    public function test_update()
    {
        // Создайте фильм и жанр
        $movie = Movie::factory()->create();
        $genre = Genre::factory()->create();

        // Подготовка данных для обновления
        $data = [
            'title' => 'Updated Movie Title',
            'genres' => [$genre->id],
        ];

        // Выполнение запроса обновления
        $response = $this->put(route('movies.update', $movie->id), $data);

        // Проверка редиректа
        $response->assertRedirect(route('movies.index'));

        // Проверка обновления в базе данных
        $this->assertDatabaseHas('movies', [
            'title' => 'Updated Movie Title',
        ]);
    }

    /**
    * Тест удаления фильма.
    */
    public function test_destroy()
    {
        $movie = Movie::factory()->create();
        $response = $this->delete(route('movies.destroy', $movie));
        $response->assertRedirect(route('movies.index'));
        $this->assertDatabaseMissing('movies', [
            'id' => $movie->id,
        ]);
    }

    /**
    * Тест публикации фильма.
    */
    public function test_publish()
    {
        $movie = Movie::factory()->create([
            'is_published' => false,
        ]);
        $response = $this->post(route('movies.publish', $movie));
        $response->assertRedirect(route('movies.index'));
        $this->assertDatabaseHas('movies', [
            'id' => $movie->id,
            'is_published' => true,
        ]);
    }
}
