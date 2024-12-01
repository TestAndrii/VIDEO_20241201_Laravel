<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    // Определение защищённых атрибутов, которые могут быть заполнены массово
    protected $fillable = ['title', 'is_published', 'poster_link'];

    // Определение отношения многие ко многим с моделью Genre
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_movie');
    }
}
