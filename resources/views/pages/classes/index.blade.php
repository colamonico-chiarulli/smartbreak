@extends('layouts.app', ['title' => 'Elenco classi'])

@section('content')
<div class="row">
    <div class="container">
        <div class="float-right mb-2">
            <a class="btn btn-success" href="{{ route('classes.create') }}">Aggiungi una classe</a>
        </div>
    </div>
</div>

<div class="card card-primary card-outline">
    <table class="table">
        <thead>
            <tr>
                <th>@sortablelink('name', 'Classe')</th>
                <th>@sortablelink('year', 'Anno')</th>
                <th>Sezione</th>
                <th>@sortablelink('course', 'Corso')</th>
                <th>Sede</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classes as $class)
            <tr id="row-{{ $class->id }}">
                <td>{{ $class->name }}</td>
                <td>{{ $class->year }}</td>
                <td>{{ $class->section }}</td>
                <td>{{ $class->course }}</td>
                <td>
                    {{ $class->site->name }}
                </td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('classes.show', $class->id) }}">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a class="btn btn-warning btn-sm" href="{{ route('classes.edit', $class->id) }}">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="javascript:;" onclick="deleteclass('{{ route('classes.destroy', $class->id) }}', '{{ $class->name }}')">
                        <i class=" fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="w-100 pl-2">
        {!! $classes->links() !!}
    </div>


</div>

</div>
@endsection

@push('js')

<script>
    function deleteclass(url, name){

        Swal.fire({
            title: 'Sei sicuro di voler eliminare la classe '+name+'?',
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
                    success: (deletedclass) => {
                        toastr.success('Classe eliminata con successo');
                        $('#row-'+deletedclass.id).remove();
                    },
                    error: (error) => {
                        toastr.error('Impossibile eliminare questa Classe');
                    }
                })
            }
        });
    }
</script>

@endpush
