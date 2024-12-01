<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Жанр {{ $genre->name }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Жанр: {{ $genre->name }}</h1>

    <div class="form-group">
        <label for="id">ID</label>
        <input type="text" class="form-control" id="id" value="{{ $genre->id }}" disabled>
    </div>

    <div class="form-group">
        <label for="name">Название</label>
        <input type="text" class="form-control" id="name" value="{{ $genre->name }}" disabled>
    </div>

    <a href="{{ route('genre.edit', $genre->id) }}" class="btn btn-warning">Редактировать</a>
    <a href="{{ route('genre.index') }}" class="btn btn-secondary">Назад</a>
</div>

</body>
</html>
