<?php
/**
 * File:	/resources/views/pages/students/index.blade.php
 * @package smartbreak
 * @author  Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	March 26th, 2021 4:06pm
 * -----
 * Last Modified: 	April 3rd 2021 2:40:31 pm
 * Modified By: 	Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * -----
 * @license	https://www.gnu.org/licenses/agpl-3.0.html AGPL 3.0
 * ------------------------------------------------------------------------------
 * SmartBreak is a School Bar food booking web application 
 * developed during the PON course "The AppFactory" 2020-2021 with teachers 
 * & students of "Informatica e Telecomunicazioni" 
 * at IISS "C. Colamonico - N. Chiarulli" Acquaviva delle Fonti (BA)-Italy
 * Expert dr. Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * ----------------------------------------------------------------------------
 * SmartBreak is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by
 * the Free Software Foundation
 * 
 * SmartBreak is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * You should have received a copy of the GNU Affero General Public License along 
 * with this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * The interactive user interfaces in original and modified versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the SmartBreak
 * logo and IISS "Colamonico-Chiarulli" copyright notice. If the display of the logo
 * is not reasonably feasible for technical reasons, the Appropriate Legal Notices 
 * must display the words
 * "(C) IISS Colamonico-Chiarulli-https://colamonicochiarulli.edu.it - 2021".
 * 
 * ------------------------------------------------------------------------------
 */

?>
@extends('layouts.app', ['title' => 'Elenco studenti'])

@section('content')
<div class="row">
    <form class="form-inline" method="GET">
        <div class="input-group mb-2">
            <input type="text" class="form-control" id="filter" name="filter" placeholder="Nominativo..."
                value="{{$filter}}">

            <span class="input-group-append">
                <button type="submit" class="btn btn-info btn-flat">
                    <i class="fas fa-search"></i>
                </button>
            </span>
            <span class="input-group-append">
                <a href="{{ route('students.index') }}" type="submit" class="btn btn-danger btn-flat">
                    <i class="fas fa-times"></i>
                </a>
            </span>
        </div>
    </form>

    <div class="col">
        <div class="float-right mb-2">
            <a class="btn btn-success" href="{{ route('students.create') }}">Aggiungi uno studente</a>
        </div>
    </div>
</div>

<div class="card card-primary card-outline">
    <table class="table">
        <thead>
            <tr>
                <th>@sortablelink('first_name', 'Nome')</th>
                <th>@sortablelink('last_name', 'Cognome')</th>
                <th>@sortablelink('email', 'Email')</th>
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
                <td>{{ $student->class->name ?? '' }}</td>
                <td>{{ $student->site->name ?? ''}}</td>
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
