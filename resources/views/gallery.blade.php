@extends('layouts.app')

@section('content')
    <h1>{{ $article['name'] }}</h1>
    <p>{{ $article['date'] }}</p>
    <img src="/{{ $article['full_image'] }}" width="600">
    <p>{{ $article['desc'] }}</p>
    <a href="/">Назад</a>
@endsection