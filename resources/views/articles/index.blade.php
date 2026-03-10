@extends('layouts.app')

@section('content')
    <h1>Статьи</h1>
    <hr>

    @foreach($articles as $article)
        <div>
            <h2><a href="/articles/{{ $article->id }}">{{ $article->name }}</a></h2>
            <img src="/{{ $article->preview_image }}" width="200">
            <p>{{ $article->desc }}</p>
            @auth
                @if(Auth::user()->role === 'moderator')
                    <a href="/articles/{{ $article->id }}/edit">Редактировать</a>
                    <form action="/articles/{{ $article->id }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Удалить?')">Удалить</button>
                    </form>
                @endif
            @endauth
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