<div class="product">

    <div class="product-title m-2">
        <b>{{ $product->name }}</b>
        <span data-toggle="tooltip" data-placement="right" title="Allergeni: {{ $product->allergens }}">
            <span class="fa-stack" style="font-size: 12px">
                <i class="far fa-circle fa-stack-2x text-success"></i>
                <i class="fas fa-leaf fa-stack-1x text-success"></i>
            </span>
        </span>
    </div>


    <div class="product-content d-flex">
        <div class="product-image d-flex align-items-center">
            <img src="{{ $product->photo_url }}" class="img-fluid">
        </div>


        <div class="product-info w-100 ml-2">
            <span class="text-muted product-description">
                {{ $product->description }}
            </span>

            <div class="my-2 d-flex justify-content-end align-items-center">

                <div class="input-group input-group-sm" style="max-width: 90px;">
                    <span class="input-group-prepend">
                        <button type="button" class="btn btn-info btn-flat"
                                onclick="editCart({{ $product->id }}, -1)"> - </button>
                    </span>
                    <input type="number" class="form-control noarrows text-center cart-product-amount"
                           id="product-{{ $product->id }}"
                           value="{{ session('cart.'.$product->id) ?? 0 }}" disabled>
                    <span class="input-group-append">
                        <button type="button" class="btn btn-info btn-flat"
                                onclick="editCart({{ $product->id }}, 1)"> + </button>
                    </span>
                </div>

            </div>

            @if($product->num_items < 2)
              <small class="text-danger mt-2">
                <i class="fas fa-exclamation-triangle"></i>Disponibilità limitata
                </small>
                @endif

        </div>
    </div>
</div>
