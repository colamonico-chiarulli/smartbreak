@extends('layouts.app', ['title' => 'Crea classe'])

@section('content')

    @include('pages.classes._form', [
        'cardTitle' => 'Inserisci nuova classe',
        'headercolor' => 'bg-success',
        'action' => route('classes.store'),
        'button' => 'Salva',
    ])

@endsection
