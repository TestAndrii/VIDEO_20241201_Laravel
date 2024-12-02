@extends('layouts.app')

@section('content')
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

@endsection
