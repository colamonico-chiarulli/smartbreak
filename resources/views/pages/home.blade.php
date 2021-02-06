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
                    {{ $category->name }}
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
    <button class="btn btn-lg btn-success btn-block">
        <i class="fa fa-shopping-cart"></i> Vai al riepilogo
    </button>
</div>


@endsection

@section('js_scripts')

@parent

<script type="text/javascript">
    function emptyCart(){
        $.ajax({
            url: '{{ route("cart.empty") }}',
            method: 'DELETE',
            success: function(){
                toastr.success("Carrello svuotato con successo");
                $('input.cart-product-amount').val(0);
            }
        })
    }

    function editCart(product_id, quantity, price){
        const product = $('#product-'+product_id);

        const result = parseInt(product.val() || 0) + quantity;
        if(result >= 0 ){
            product.val(result);

            $.ajax({
                url: '{{ route("cart.edit") }}',
                method: 'PUT',
                data: {
                    product_id : product_id,
                    quantity: result
                },
                success: function(){
                    console.log('added');
                }
            })

        }
        }
</script>
@endsection
