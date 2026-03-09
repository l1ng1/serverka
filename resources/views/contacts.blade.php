@extends('layouts.app')

@section('content')
    <h1>Контакты</h1>
    @foreach($contacts as $contact)
        <p>{{ $contact['name'] }} - {{ $contact['phone'] }}</p>
    @endforeach
@endsection