@extends('layouts.app', ['title' => 'Home page'])

@section('content')

<div class="text-right mb-2">
    <a class="text-danger" href="javascript:;" onclick="emptyCart()">
        <i class="fa fa-cart-arrow-down"></i> Svuota carrello
    </a>
</div>

@foreach($categories as $category)
<div id="accordion">
    <div class="card card-default">
        <div class="card-header">
            <h4 class="card-title w-100">
                <a class="d-block w-100" data-toggle="collapse" href="#category-{{ $category->id }}">
                    {{ $category->name }} <small class="text-muted">{{ $category->products->count() }} prodotti</small>
                </a>
            </h4>
        </div>
        <div id="category-{{ $category->id }}" class="{{ $loop->first ? '' : 'collapse' }}" data-parent="#accordion">
            <div class="card-body">
                @foreach($category->products as $product)
                @include('partials._product-card', ['product' => $product])
                @endforeach
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="text-center">
    <a class="btn btn-lg btn-success btn-block" href="{{ route('cart.checkout') }}">
        <i class="fa fa-shopping-cart"></i> Vai al riepilogo
    </a>
</div>


@endsection

@section('js_scripts')

@parent

@include('partials._cartjs', ['products' => $categories->pluck('products')->collapse()->keyBy('id')])

@endsection
