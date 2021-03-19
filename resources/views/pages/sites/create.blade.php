@extends('layouts.app', ['title' => 'Crea categoria'])

@section('content')

    @include('pages.sites._form', [
        'cardTitle' => 'Inserisci nuova categoria',
        'headercolor' => 'bg-success',
        'action' => route('sites.store'),
        'button' => 'Salva',
    ])

@endsection
