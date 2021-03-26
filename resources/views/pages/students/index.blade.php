@extends('layouts.app', ['title' => 'Elenco studenti'])

@section('content')
<div class="row">
    <div class="container">
        <div class="float-right mb-2">
            <a class="btn btn-success" href="{{ route('students.create') }}">Aggiungi uno studente</a>
        </div>
    </div>
</div>

<div class="card card-primary card-outline">
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Email</th>
                <th>Classe</th>
                <th>Sede</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            <tr id="row-{{ $student->id }}">
                <td>{{ $student->first_name }}</td>
                <td>{{ $student->last_name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->class->name }}</td>
                <td>{{ $student->site->name }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('students.show', $student->id) }}">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a class="btn btn-warning btn-sm" href="{{ route('students.edit', $student->id) }}">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="javascript:;" onclick="deleteUser('{{ route('students.destroy', $student->id) }}', '{{ $student->last_name }} {{ $student->first_name }}')">
                        <i class=" fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="w-100 pl-2">
        {!! $students->links() !!}
    </div>
</div>

</div>
@endsection

@push('js')

<script>
    function deleteUser(url, name){

        Swal.fire({
            title: "Sei sicuro di voler eliminare l'utente "+name+'?',
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
                    success: (deletedUser) => {
                        toastr.success('Utente eliminato con successo');
                        $('#row-'+deletedUser.id).remove();
                    },
                    error: (error) => {
                        toastr.error('Impossibile eliminare questo utente');
                    }
                })
            }
        });
    }
</script>

@endpush
