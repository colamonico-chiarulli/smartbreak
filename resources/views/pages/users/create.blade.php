@extends('layouts.app', ['title' => 'Crea utente'])

@section('content')

    @include('pages.users._form', [
        'cardTitle' => 'Inserisci nuovo utente',
        'headercolor' => 'bg-success',
        'action' => route('users.store'),
        'button' => 'Salva',
        'setPassword' => True,
    ])

@endsection
