<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать Жанр</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Редактировать Жанр</h1>

    <form action="{{ route('genres.update', $genre->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $genre->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Обновить</button>
        <a href="{{ route('genres.index') }}" class="btn btn-secondary">Назад</a>
    </form>
</div>

</body>
</html>
