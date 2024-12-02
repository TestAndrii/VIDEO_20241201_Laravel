<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Создание 10 жанров
        Genre::factory()->count(10)->create();

        // Создание 10 фильмов
        Movie::factory()->count(10)->create()->each(function ($movie) {
            // Привязка случайных жанров к каждому фильму
            $genres = Genre::all()->random(rand(1, 3)); // Привязываем от 1 до 3 случайных жанров
            $movie->genres()->attach($genres); // Сохраняем привязку
        });
    }
}
