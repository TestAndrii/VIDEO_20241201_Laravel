@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Редактировать фильм: {{ $movie->title }}</h1>

        <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Название</label>
                <input type="text" name="title" class="form-control" value="{{ $movie->title }}" required>
            </div>
            <div class="form-group">
                <label for="poster">Постер фильма</label>
                <input type="file" name="poster" class="form-control">
                <img src="{{ $movie->poster_link }}" alt="{{ $movie->title }}" style="width: 100px; margin-top: 10px;">
            </div>
            <div class="form-group">
                <label for="genres">Жанры</label>
                <select name="genres[]" class="form-control" multiple>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" {{ in_array($genre->id, $movie->genres->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $genre->name }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Выберите один или несколько жанров.</small>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </form>
    </div>
@endsection
