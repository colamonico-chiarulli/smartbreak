@extends('layouts.app', ['title' => 'Visualizza Categoria'])

@section('content')

    @include('pages.categories._form', [
            'cardTitle' => 'Dettaglio categoria',
            'action' => route('categories.index'),
            'button' => 'Indietro',
            'readonly' => 'readonly',
            ])

@endsection