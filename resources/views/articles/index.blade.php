@extends('layouts.app')

@section('content')
    <h1>Статьи</h1>

    @foreach($articles as $article)
        <div>
            <h2>{{ $article->name }}</h2>
            <img src="/{{ $article->preview_image }}" width="200">
            <p>{{ $article->desc }}</p>
        </div>
        <hr>
    @endforeach
@endsection