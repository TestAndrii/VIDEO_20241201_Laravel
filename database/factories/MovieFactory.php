<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    protected $model = Movie::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3, true), // Генерируем случайное название фильма
            'is_published' => $this->faker->boolean(70), // 70% вероятности, что фильм будет опубликован
            'poster_link' => 'posters/default.jpg', // Установить значение по умолчанию для изображения
        ];
    }
}
