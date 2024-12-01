@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Список фильмов</h1>
        <a href="{{ route('movies.create') }}" class="btn btn-primary">Добавить новый фильм</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>Название</th>
                <th>Постер</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($movies as $movie)
                <tr>
                    <td>{{ $movie->title }}</td>
                    <td>
                        <img src="{{ $movie->poster_link }}" alt="{{ $movie->title }}" style="width: 100px;">
                    </td>
                    <td>
                        <form action="{{ route('movies.publish', $movie->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-warning">
                                {{ $movie->is_published ? 'Удалить публикацию' : 'Опубликовать' }}
                            </button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-info">Просмотр</a>
                        <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning">Редактировать</a>
                        <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endsection
