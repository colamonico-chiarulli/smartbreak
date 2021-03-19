@extends('layouts.app', ['title' => 'Visualizza utente'])

@section('content')

    @include('pages.users._form', [
            'cardTitle' => 'Dettaglio utente',
            'action' => route('users.index'),
            'button' => 'Indietro',
            'readonly' => 'readonly',
            ])

@endsection