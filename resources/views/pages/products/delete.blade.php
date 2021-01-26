@extends('layouts.app', ['title' => 'Cancella prodotto'])

@section('content')

    @include('pages.products.form', [
        'cardTitle' => 'Cancella un prodotto',
        'headercolor' => 'bg-danger',
        'action' => route('products.destroy', $product->id),
        'button' => 'Cancella',
        'method' => "DELETE",
        ])

@endsection