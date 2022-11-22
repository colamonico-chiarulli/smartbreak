<?php
/**
 * File:	\resources\views\pages\messages\index.blade.php
 * @package smartbreak
 * @author  Fabio Caccavone <fabio.caccavone.inf@colamonicochiarulli.edu.it>
 * @copyright	(c)2022 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: Tuesday, November 22nd 2022, 5:05:14 pm
 * -----
 * Last Modified: 	November 22nd 2022 5:09:13 pm
 * Modified By: 	Fabio Caccavone <fabio.caccavone.inf@colamonicochiarulli.edu.it>
 * -----
 * HISTORY:
 * Date      	By           	Comments
 * ----------	-------------	----------------------------------
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
 * "(C) IISS Colamonico-Chiarulli-https://colamonicochiarulli.edu.it - 2022".
 * 
 * ------------------------------------------------------------------------------
 */

?>
@extends('layouts.app', ['title' => 'Elenco messaggi'])
@section('content')
<div class="row">
    <div class="container">
        <div class="float-right mb-2">
            <a class="btn btn-success" href="{{ route('messages.create') }}">Aggiungi un messaggio</a>
        </div>
    </div>
</div>
<div class="card card-primary card-outline">
    <table class="table">
        <thead>
            <tr>
                <th>@sortablelink('title', 'Titolo')</th>
                <th>@sortablelink('message', 'Messaggio')</th>
                <th>@sortablelink('destination', 'Destinatari')</th>
                <th>@sortablelink('created_at', 'Data')</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
            <tr id="row-{{ $message->id }}">
                <td>{{ $message->title }}</td>
                <td>{{ Str::limit($message->message, 30) }}</td>
                <td>{{ $message->destination }}</td>
                <td>{{ date('d/m/Y', strtotime($message->created_at))}}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('messages.show', $message->id) }}">
                        <i class="fas fa-eye" title="Vedi"></i>
                    </a>                        
                    <a class="btn btn-warning btn-sm" href="{{ route('messages.edit', $message->id) }}">
                            <i class="fas fa-pencil-alt" title="Modifica"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="javascript:;" onclick="deleteMessage('{{ route('messages.destroy', $message->id) }}', '{{ $message->id }}')">
                        <i class=" fas fa-trash" title="Cancella"></i>
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
    function deleteMessage(url, id){
        Swal.fire({
            title: 'Sei sicuro di voler eliminare il messaggio '+id+'?',
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
                    success: (deletedMessage) => {
                        toastr.success('Messaggio eliminato con successo!');
                        $('#row-'+deletedMessage.id).remove();
                    },
                    error: (error) => {
                        toastr.error('Impossibile eliminare questo messaggio!');
                    }
                })
            }
        });
    }
</script>
@endpush
