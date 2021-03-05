@extends('layouts.app', ['title' => 'Crea categoria'])

@section('content')

    @include('pages.categories._form', [
        'cardTitle' => 'Inserisci nuova categoria',
        'headercolor' => 'bg-success',
        'action' => route('categories.store'),
        'button' => 'Salva',
    ])

@endsection
