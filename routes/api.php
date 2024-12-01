<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('genres', GenreController::class);
Route::get('genres/{id}/movies', [MovieController::class, 'moviesByGenre']);
Route::apiResource('movies', MovieController::class);
