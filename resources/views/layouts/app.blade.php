<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мой сайт</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<header>
    <nav>
        <a href="/">Главная</a> |
        <a href="/about">О нас</a> |
        <a href="/contacts">Контакты</a> |
        <a href="/articles">Статьи</a> |
        @auth
            @if(Auth::user()->role === 'moderator')
                <a href="/articles/create">Добавить статью</a> |
                <a href="/moderation">Модерация</a> |
            @endif
            <form action="/logout" method="POST" style="display:inline">
                @csrf
                <button type="submit">Выйти ({{ Auth::user()->name }})</button>
            </form>
        @else
            <a href="/login">Войти</a> |
            <a href="/signin">Регистрация</a>
        @endauth
    </nav>
</header>

<main>
    <div id="app"></div>
    @yield('content')
</main>

<footer>
    <p>Карлин Пётр, группа 241-3210</p>
</footer>

</body>
</html>