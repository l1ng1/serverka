@extends('layouts.app')

@section('content')
    <h1>Статьи</h1>
    <a href="/articles/create">Добавить статью</a>
    <hr>

    @foreach($articles as $article)
        <div>
            <h2>{{ $article->name }}</h2>
            <img src="/{{ $article->preview_image }}" width="200">
            <p>{{ $article->desc }}</p>
            <a href="/articles/{{ $article->id }}/edit">Редактировать</a>
            <form action="/articles/{{ $article->id }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Удалить?')">Удалить</button>
            </form>
        </div>
        <hr>
    @endforeach

    <div>
        @if($articles->onFirstPage() == false)
            <a href="{{ $articles->previousPageUrl() }}">Назад</a>
        @endif
        Страница {{ $articles->currentPage() }} из {{ $articles->lastPage() }}
        @if($articles->hasMorePages())
            <a href="{{ $articles->nextPageUrl() }}">Вперёд</a>
        @endif
    </div>
@endsection