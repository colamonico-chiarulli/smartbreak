@extends('layouts.app', ['title' => 'Elenco categorie'])

@section('content')
<div class="row">
    <div class="container">
        <div class="float-right mb-2">
            <a class="btn btn-success" href="{{ route('categories.create') }}">Aggiungi una categoria</a>
        </div>
    </div>
</div>

<div class="card card-primary card-outline">
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrizione</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr id="row-{{ $category->id }}">
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('categories.show', $category->id) }}">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a class="btn btn-warning btn-sm" href="{{ route('categories.edit', $category->id) }}">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="javascript:;" onclick="deleteCategory('{{ route('categories.destroy', $category->id) }}', '{{ $category->name }}')">
                        <i class=" fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="w-100 pl-2">
        {!! $categories->links() !!}
    </div>


</div>

</div>
@endsection

@push('js')

<script>
    function deleteCategory(url, name){

        Swal.fire({
            title: 'Sei sicuro di voler eliminare la categoria '+name+'?',
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
                    success: (deletedCategory) => {
                        toastr.success('Categiria eliminata con successo');
                        $('#row-'+deletedCategory.id).remove();
                    },
                    error: (error) => {
                        toastr.error('Impossibile eliminare questa categoria');
                    }
                })
            }
        });
    }
</script>

@endpush
