<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = Genre::factory()->count(5)->create();  // Создание 5 жанров

        Movie::factory()->count(20)->create()->each(function ($movie) use ($genres) {
            $movie->genres()->attach($genres->random(rand(1, 3))->pluck('id')); // Присвоение 1-3 жанров каждому фильму
        });
    }
}
