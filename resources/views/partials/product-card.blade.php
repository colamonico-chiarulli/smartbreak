<div class="product">

    <div class="product-title m-2">
        <b>{{ $product->name }}</b>
        <span class="fa-stack" data-toggle="tooltip" data-placement="top" title="Allergeni: {{ $product->allergens }}"
              style="font-size: 12px">
            <i class="far fa-circle fa-stack-2x text-success"></i>
            <i class="fas fa-leaf fa-stack-1x text-success"></i>
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

            <div class="my-2 d-flex justify-content-between align-items-center">

                <span class="info-box-number">{{ $product->formatted_price }}</span>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-primary"> - </button>
                    <button type="button" class="btn btn-sm btn-default btn-disbled">0</button>
                    <button type="button" class="btn btn-sm btn-primary"> + </button>
                </div>

            </div>

            @if($product->num_items < 2)
              <small class="text-danger mt-2">
                <i class="fas fa-exclamation-triangle"></i>
                Disponibilità limitata
                </small>
                @endif

        </div>
    </div>
</div>
