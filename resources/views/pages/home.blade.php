@extends('layouts.app', ['title' => 'Home page'])

@section('content')

<div class="d-flex justify-content-between mb-2">

    <form action="{{ route('cart.choose-products') }}">
        <div class="input-group" style="max-width: 400px;">
            <input name="search_name" type="text" class="form-control" value="{{ $search_name }}">
            <span class="input-group-append">
                <button type="submit" class="btn btn-info btn-flat">
                    <i class="fas fa-search"></i>
                </button>
            </span>
            <span class="input-group-append">
                <a href="{{ route('cart.choose-products') }}" type="submit" class="btn btn-danger btn-flat">
                    <i class="fas fa-times"></i>
                </a>
            </span>
        </div>
    </form>


    <a class="text-danger" href="javascript:;" onclick="emptyCart()">
        <i class="fa fa-cart-arrow-down"></i> Svuota carrello
    </a>

</div>



@foreach($categories as $category)
    @if($category->products->count())
    <div id="accordion">
        <div class="card card-default">
            <div class="card-header">
                <h4 class="card-title w-100">
                    <a class="d-block w-100" data-toggle="collapse" href="#category-{{ $category->id }}">
                        {{ $category->name }} <small class="text-muted">{{ $category->products->count() }} prodotti</small>
                    </a>
                </h4>
            </div>
            <div id="category-{{ $category->id }}" class="{{ $loop->first ? 'show' : 'collapse' }}">
                <div class="card-body">
                    @foreach($category->products as $product)
                    @include('partials._product-card', ['product' => $product])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
@endforeach

<div class="text-center">
    <a class="btn btn-lg btn-success btn-block" href="{{ route('cart.checkout') }}">
        <i class="fa fa-shopping-cart"></i> Vai al riepilogo
    </a>
</div>


@endsection

@push('js')

    @include('partials._cartjs', ['products' => $categories->pluck('products')->collapse()->keyBy('id')])

@endpush
