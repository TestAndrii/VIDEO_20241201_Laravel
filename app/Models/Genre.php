<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    // Определение защищённых атрибутов, которые могут быть заполнены массово
    protected $fillable = ['name'];

    // Определение отношения многие ко многим с моделью Movie
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'genre_movie');
    }
}
