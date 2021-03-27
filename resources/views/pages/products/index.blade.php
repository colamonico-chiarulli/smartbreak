@extends('layouts.app', ['title' => 'Elenco prodotti'])

@section('content')
<div class="row">
    <form class="form-inline" method="GET">
        <div class="form-group mb-2">
          <label for="filter" class="col-sm-2 col-form-label">Filtro</label>
          <input type="text" class="form-control" id="filter" name="filter" placeholder="Nome prodotto..." value="{{$filter}}">
        </div>
        <button type="submit" class="btn btn-default mb-2">Filtra</button>
      </form>

    <div class="col">
        <div class="float-right mb-2">
            <a class="btn btn-success" href="{{ route('products.create') }}">Aggiungi un prodotto</a>
        </div>
    </div>
</div>

<div class="card card-primary card-outline">
    <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    @can('is-admin')
                    <th>Sede</th>    
                    @endcan
                    <th></th>
                    <th>@sortablelink('name', 'Nome')</th>
                    <th>@sortablelink('price', 'Prezzo')</th>
                    <th>@sortablelink('num_items', 'Disponibilità')</th>
                    <th>Categoria</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr id="row-{{ $product->id }}">
                    @can('is-admin')
                        <td>{{ $product->site->name }}</td>
                    @endcan

                    <td>
                        <img src="{{ asset('img/products/' . $product->photo_path) }}" alt="" width="35px">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ formatPrice($product->price) }}</td>
                    <td>
                        @if ($product->num_items <= 10) <span class="badge badge-danger">
                            {{ $product->num_items }}
                            </span>
                            @else
                            <span class="badge badge-success">
                                {{ $product->num_items }}
                            </span>
                            @endif

                    </td>
                    <td>
                        {{ $product->category->name }}
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('products.show', $product->id) }}">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a class="btn btn-warning btn-sm" href="{{ route('products.edit', $product->id) }}">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="javascript:;"
                            onclick="deleteProduct('{{ route('products.destroy', $product->id) }}', '{{ $product->name }}')">
                            <i class=" fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="w-100 pl-2">
        {!! $products->links() !!}
    </div>


</div>

</div>
@endsection

@push('js')

<script>
    function deleteProduct(url, name){

        Swal.fire({
            title: 'Sei sicuro di voler eliminare il prodotto '+name+'?',
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Conferma',
            cancelButtonText: 'Annulla'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url,
                    method: 'DELETE',
                    success: (deletedProduct) => {
                        toastr.success('Prodotto eliminato con successo');
                        $('#row-'+deletedProduct.id).remove();
                    },
                    error: (error) => {
                        toastr.error('Impossibile eliminare questo prodotto');
                    }
                })
            }
        });
    }
</script>

@endpush