<?php
/**
 * File:	\resources\views\pages\sites\switch.blade.php
 * @package smartbreak
 * @author  Fabio Caccavone <fabio.caccavone.inf@colamonicochiarulli.edu.it>
 * @copyright	(c)2022 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: Saturday, November 26th 2022, 2:58:38 pm
 * -----
 * Last Modified: 	November 26th 2022 4:40:50 pm
 * Modified By: 	Fabio Caccavone <fabio.caccavone.inf@colamonicochiarulli.edu.it>
 * -----
 * HISTORY:
 * Date      	By           	Comments
 * ----------	-------------	----------------------------------
 * 2022-11-26	F. Caccavone	Page to show different sites and their unprepared orders
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
@extends('layouts.app', ['title' => 'Cambia sede'])

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Elenco Sedi</h3>
    </div>

    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 10px">Id</th>
                    <th>Nome</th>
                    <th>Ordini da preparare</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sites as $site)
                <tr>
                    <td>{{ $site->id }}</td>
                    <td>{{ $site->name }}</td>
                    <td><span class="badge bg-info">{{ $orders[$site->id] }}</span></td>
                    <td><a onclick="deletesite('{{ route('sites.switch', $site->id) }}', '{{ $site->name }}', '{{ $site->id }}')" class="btn btn-success">Vai alla sede</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('js')

<script>
    function deletesite(url, name, id){
        Swal.fire({
            title: 'Sei sicuro di voler passare alla sede '+name+'?',
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Conferma',
            cancelButtonText: 'Annulla'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url,
                    method: 'POST',
                    data:{
                        site_id: id,
                    },
                    success: () => {
                        toastr.success('La sede è stata cambiata!');
                    },
                    error: (error) => {
                        toastr.error('Impossibile cambiare sede');
                    }
                })
            }
        });
    }
</script>

@endpush