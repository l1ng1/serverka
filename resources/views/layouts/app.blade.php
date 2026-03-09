<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мой сайт</title>
</head>
<body>

<header>
    <nav>
        <a href="/">Главная</a> |
        <a href="/about">О нас</a> |
        <a href="/contacts">Контакты</a>
    </nav>
</header>

<main>
    @yield('content')
</main>

<footer>
    <p>Карлин Пётр, группа 241-3210</p>
</footer>

</body>
</html>