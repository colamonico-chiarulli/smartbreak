@extends('layouts.app', ['title' => 'Modifica prodotto'])

@section('content')

    @include('pages.products.form', [
            'cardTitle' => 'Modifica un prodotto',
            'headercolor' => 'bg-info',
            'action' => route('products.update', $product->id),
            'button' => 'Aggiorna',
            'method' => "PUT",
            ])

@endsection