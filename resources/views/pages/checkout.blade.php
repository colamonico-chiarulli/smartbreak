@extends('layouts.app', ['title' => 'Riepilogo ordine'])

@section('content')

@foreach($products as $product)
@include('partials._product-card', ['product' => $product])
@endforeach

<div class="text-right">
    <h4>Totale carrello: <b>€ 25,00</b></h4>
    <button class="btn btn-success btn-lg">
        <i class="fa fa-check"></i> Conferma ordine
    </button>
</div>


@endsection

@section('js_scripts')
@parent

<script>
    const edit_cart_route = '{{ route("cart.edit") }}';
    const empty_cart_route = '{{ route("cart.empty") }}';
</script>

<script src="{{ asset('js/cart.js') }}"></script>

@endsection
