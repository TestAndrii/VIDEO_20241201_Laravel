<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * @param Request $request
     * @param $perPage
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, $perPage = 10)
    {
        // Получение фильмов с пагинацией
        $perPage = $request->input('per_page', $perPage);
        $movies = Movie::with('genres')->paginate($perPage);

        return response()->json($movies);
    }

    public function show($id)
    {
        $movie = Movie::with('genres')->findOrFail($id);

        return response()->json($movie);
    }
}
