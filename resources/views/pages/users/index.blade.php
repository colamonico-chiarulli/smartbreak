@extends('layouts.app', ['title' => 'Elenco utenti'])

@section('content')
<div class="row">
    <div class="container">
        <div class="float-right mb-2">
            <a class="btn btn-success" href="{{ route('users.create') }}">Aggiungi un utente</a>
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
                <th>Ruolo</th>
                <th>Sede</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr id="row-{{ $user->id }}">
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->site->name ?? '' }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('users.show', $user->id) }}">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a class="btn btn-warning btn-sm" href="{{ route('users.edit', $user->id) }}">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="javascript:;" onclick="deleteUser('{{ route('users.destroy', $user->id) }}', '{{ $user->last_name }} {{ $user->first_name }}')">
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
