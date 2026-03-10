@extends('layouts.app')

@section('content')
    <h1>Модерация комментариев</h1>

    @if($comments->isEmpty())
        <p>Нет комментариев на модерации.</p>
    @else
        @foreach($comments as $comment)
            <div>
                <p><strong>Статья:</strong> {{ $comment->article->name }}</p>
                <p><strong>Пользователь:</strong> {{ $comment->user->name }}</p>
                <p><strong>Комментарий:</strong> {{ $comment->content }}</p>
                <form action="/comments/{{ $comment->id }}/approve" method="POST" style="display:inline">
                    @csrf
                    <button type="submit">Принять</button>
                </form>
                <form action="/comments/{{ $comment->id }}/reject" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Отклонить</button>
                </form>
            </div>
            <hr>
        @endforeach
    @endif
@endsection