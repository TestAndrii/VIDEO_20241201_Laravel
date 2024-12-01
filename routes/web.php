<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::Resource('genres', GenreController::class);
Route::resource('movies', MovieController::class);
Route::post('movies/{id}/publish', [MovieController::class, 'publish'])->name('movies.publish');
