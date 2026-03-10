@extends('layouts.app')

@section('content')
    <h1>Регистрация</h1>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="/signin" method="POST">
        @csrf

        <div>
            <label>Имя:</label><br>
            <input type="text" name="name" value="{{ old('name') }}">
        </div>
        <div>
            <label>Email:</label><br>
            <input type="email" name="email" value="{{ old('email') }}">
        </div>
        <div>
            <label>Пароль:</label><br>
            <input type="password" name="password">
        </div>
        <br>
        <button type="submit">Зарегистрироваться</button>
    </form>
@endsection