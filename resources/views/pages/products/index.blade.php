@extends('layouts.app', ['title' => 'Elenco prodotti'])

@section('content')
<div class="row">
    <div class="container">
        <div class="float-right mb-2">
            <a class="btn btn-success" href="{{ route('products.create') }}">Aggiungi un prodotto</a>
        </div>
    </div>
</div>

<div class="card card-primary card-outline">
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Nome</th>
                <th>Prezzo</th>
                <th>Disponibilità</th>
                <th>Categoria</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr id="row-{{ $product->id }}">
                <td>
                    <img src="{{ asset('img/products/' . $product->photo_path) }}" alt="" width="35px">
                </td>
                <td>{{ $product->name }}</td>
                <td>€ {{ $product->price }}</td>
                <td>
                    @if ($product->num_items <= 10)
                    <span class="badge badge-danger">
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
                    <a class="btn btn-danger btn-sm" href="javascript:;" onclick="deleteProduct('{{ route('products.destroy', $product->id) }}')">
                        <i class=" fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="w-100 pl-2">
        {!! $products->links() !!}
    </div>


</div>

</div>
@endsection

@push('js')

<script>
    function deleteProduct(url){

        Swal.fire({
            title: 'Sei sicuro di voler eliminare questo prodotto?',
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
                    }
                })
            }
        });
    }
</script>

@endpush
