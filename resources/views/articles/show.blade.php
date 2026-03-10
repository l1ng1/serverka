@extends('layouts.app')

@section('content')
    <h1>{{ $article->name }}</h1>
    <img src="/{{ $article->preview_image }}" width="300">
    <p>{{ $article->desc }}</p>

    <h2>Комментарии</h2>

    @if(session('comment_pending'))
        <p style="color:orange">{{ session('comment_pending') }}</p>
    @endif

    @foreach($article->comments->where('is_approved', true) as $comment)
        <div>
            <strong>{{ $comment->user->name }}</strong>
            <p>{{ $comment->content }}</p>
        </div>
        <hr>
    @endforeach

    @auth
        <h3>Оставить комментарий</h3>
        <form action="/articles/{{ $article->id }}/comments" method="POST">
            @csrf
            <textarea name="content" rows="3"></textarea><br>
            <button type="submit">Отправить</button>
        </form>
    @else
        <p><a href="/login">Войдите</a>, чтобы оставить комментарий.</p>
    @endauth
@endsection