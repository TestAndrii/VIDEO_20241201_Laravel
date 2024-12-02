@extends('layouts.app')

@section('content')
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

@endsection
