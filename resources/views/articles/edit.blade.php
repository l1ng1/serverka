@extends('layouts.app')

@section('content')
    <h1>Редактировать статью</h1>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p style="color:red">{{ $error }}</p>
        @endforeach
    @endif

    <form action="/articles/{{ $article->id }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Название:</label><br>
            <input type="text" name="name" value="{{ old('name', $article->name) }}">
        </div>
        <div>
            <label>Текст:</label><br>
            <textarea name="desc" rows="5">{{ old('desc', $article->desc) }}</textarea>
        </div>
        <br>
        <button type="submit">Сохранить</button>
        <a href="/articles">Отмена</a>
    </form>
@endsection