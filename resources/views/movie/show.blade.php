@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $movie->title }}</h1>
        <img src="{{ $movie->poster_link }}" alt="{{ $movie->title }}" style="width: 300px;">

        <h3>Описание</h3>
        <p>{{ $movie->description }}</p>

        <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning">Редактировать</a>
        <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Удалить</button>
        </form>
        <a href="{{ route('movies.index') }}" class="btn btn-secondary">Назад к списку</a>
    </div>
@endsection
