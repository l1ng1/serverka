@extends('layouts.app')

@section('content')
    <h1>Новости</h1>

    @foreach($articles as $id => $article)
        <div>
            <h2>{{ $article['name'] }}</h2>
            <p>{{ $article['date'] }}</p>
            @if(isset($article['shortDesc']))
                <p>{{ $article['shortDesc'] }}</p>
            @endif
            <a href="/gallery/{{ $id }}">
                <img src="/{{ $article['preview_image'] }}" width="300">
            </a>
        </div>
        <hr>
    @endforeach
@endsection