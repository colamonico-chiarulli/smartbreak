@extends('layouts.app', ['title' => 'Crea prodotto'])

@section('content')

    @include('pages.products.form', [
        'cardTitle' => 'Inserisci nuovo prodotto',
        'headercolor' => 'bg-success',
        'action' => route('products.store'),
        'button' => 'Salva',
        ])

@endsection