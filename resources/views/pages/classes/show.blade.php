@extends('layouts.app', ['title' => 'Visualizza Classe'])

@section('content')

    @include('pages.classes._form', [
            'cardTitle' => 'Dettaglio classe',
            'action' => route('classes.index'),
            'button' => 'Indietro',
            'readonly' => 'readonly',
            ])

@endsection