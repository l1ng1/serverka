@extends('layouts.app')

@section('content')
    <h1>Вход</h1>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p style="color:red">{{ $error }}</p>
        @endforeach
    @endif

    <form action="/login" method="POST">
        @csrf
        <div>
            <label>Email:</label><br>
            <input type="email" name="email" value="{{ old('email') }}">
        </div>
        <div>
            <label>Пароль:</label><br>
            <input type="password" name="password">
        </div>
        <br>
        <button type="submit">Войти</button>
        <a href="/signin">Регистрация</a>
    </form>
@endsection