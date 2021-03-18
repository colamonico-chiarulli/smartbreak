@extends('layouts.app', ['title' => 'Elenco sedi'])

@section('content')
<div class="row">
    <div class="container">
        <div class="float-right mb-2">
            <a class="btn btn-success" href="{{ route('sites.create') }}">Aggiungi una sede</a>
        </div>
    </div>
</div>

<div class="card card-primary card-outline">
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrizione</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sites as $site)
            <tr id="row-{{ $site->id }}">
                <td>{{ $site->name }}</td>
                <td></td>
                <td>
                    <a class="btn btn-warning btn-sm" href="{{ route('sites.edit', $site->id) }}">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="javascript:;" onclick="deletesite('{{ route('sites.destroy', $site->id) }}', '{{ $site->name }}')">
                        <i class=" fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


</div>

</div>
@endsection

@push('js')

<script>
    function deletesite(url, name){

        Swal.fire({
            title: 'Sei sicuro di voler eliminare la sede '+name+'?',
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
                    success: (deletedsite) => {
                        toastr.success('Sede eliminata con successo');
                        $('#row-'+deletedsite.id).remove();
                    },
                    error: (error) => {
                        toastr.error('Impossibile eliminare questa sede');
                    }
                })
            }
        });
    }
</script>

@endpush
