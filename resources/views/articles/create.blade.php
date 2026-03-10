@extends('layouts.app')

@section('content')
    <h1>Новая статья</h1>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p style="color:red">{{ $error }}</p>
        @endforeach
    @endif

    <form action="/articles" method="POST">
        @csrf
        <div>
            <label>Название:</label><br>
            <input type="text" name="name" value="{{ old('name') }}">
        </div>
        <div>
            <label>Текст:</label><br>
            <textarea name="desc" rows="5">{{ old('desc') }}</textarea>
        </div>
        <br>
        <button type="submit">Создать</button>
        <a href="/articles">Отмена</a>
    </form>
@endsection