<?php
/**
 * File:	/resources/views/pages/products/index.blade.php
 * @package smartbreak
 * @author  Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	January 22nd, 2021 9:12pm
 * -----
 * Last Modified: 	April 3rd 2021 12:25:40 pm
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
@extends('layouts.app', ['title' => 'Elenco prodotti'])

@section('content')
<div class="row">
    <form class="form-inline" method="GET">
        <div class="input-group mb-2">
            <input type="text" class="form-control" id="filter" name="filter" placeholder="Nome prodotto..."
                value="{{$filter}}">

            <span class="input-group-append">
                <button type="submit" class="btn btn-info btn-flat">
                    <i class="fas fa-search"></i>
                </button>
            </span>
            <span class="input-group-append">
                <a href="{{ route('products.index') }}" type="submit" class="btn btn-danger btn-flat">
                    <i class="fas fa-times"></i>
                </a>
            </span>
        </div>
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

                    <td class="text-center">
                        <img src="{{ $product->getFirstMediaUrl('product_photo') }}" alt="" height="35px">
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
