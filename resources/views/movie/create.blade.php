@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Добавить фильм</h1>

        <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Название</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Описание</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="poster">Постер</label>
                <input type="file" name="poster" class="form-control">
            </div>

            <div class="form-group">
                <label for="genres">Жанры</label>
                <select name="genres[]" class="form-control" multiple>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Выберите один или несколько жанров.</small>
            </div>

            <button type="submit" class="btn btn-primary">Создать фильм</button>
        </form>
    </div>
@endsection
