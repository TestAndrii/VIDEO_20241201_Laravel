<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Film App') }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('movies.index') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('movies.index') }}">Фильмы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('movies.create') }}">Добавить фильм</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('genres.index') }}">Жанры</a> <!-- Добавленная ссылка -->
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container my-4">
    @yield('content')
</main>

<footer class="text-center py-4">
    <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Все права защищены.</p>
</footer>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
