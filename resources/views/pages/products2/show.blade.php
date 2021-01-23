@extends('layouts.app', ['title' => 'Visualizza Prodotto'])

@section('content')

    @include('pages.products2.form', [
            'cardTitle' => 'Dettagli prodotto',
            'action' => route('products.index'),
            'button' => 'Indietro',
            'readonly' => 'readonly',
            ])

@endsection