@extends('layouts.app', ['title' => 'Riepilogo ordine'])

@section('content')


@forelse($products as $product)
@include('partials._product-card', ['product' => $product])
@empty
<p class="text-center text-muted">🛒 &nbsp;Il carrello è al momento vuoto. <a href="{{ route('home') }}">Vai alla
        home</a></p>
@endforelse

@if($products->count() > 0)
<div class="text-right mb-3">
    <h4 class="my-4">Totale carrello: <b class="cart-total"></b></h4>
    <button class="btn btn-success btn-lg">
        <i class="fa fa-check"></i> Conferma ordine
    </button>
</div>
@endif

@endsection

@section('js_scripts')
@parent

@include('partials._cartjs', ['products' => $products->keyBy('id')])

@endsection
