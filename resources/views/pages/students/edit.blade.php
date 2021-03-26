@extends('layouts.app', ['title' => 'Modifica utente'])

@section('content')

@include('pages.users._form', [
    'cardTitle' => 'Modifica un utente',
    'headercolor' => 'bg-info',
    'action' => route('users.update', $user->id),
    'button' => 'Aggiorna',
    'method' => "PUT",
    'setPassword' => True,
])

@endsection
