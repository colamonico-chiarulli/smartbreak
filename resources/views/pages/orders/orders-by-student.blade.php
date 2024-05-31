<?php
/**
 * File:	/resources/views/pages/orders/orders-by-student.blade.php
 * @package smartbreak
 * @author  Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: Saturday, April 10th 2021, 10:25:26 am
 * -----
 * Last Modified: 	December 3rd 2022 3:27:22 am
 * Modified By: 	Camilla Vaira <camilla.vaira.inf@colamonicochiarulli.edu.it>
 * -----
 * HISTORY:
 * Date      	By           	Comments
 * ----------	-------------	----------------------------------
 * 2022-12-03	C. Vaira	    reBuy Feature
 * 2022-10-20	G. Giorgio	    Fix: cart badge & total in navbar
 * 2021-05-21	R. Andriano     Added order status message	
 * 2021-04-10	R. Andriano	    First release (Order by class OrderByStudent)
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

@extends('layouts.app', ['title' => 'I miei Ordini'])

@section('content')

<div id="student-accordion">
    @foreach($orders_by_day as $date=>$order)
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title w-75 text-bold">
                <a class="d-block w-75 collapsed " data-toggle="collapse" href="#data-{{$date}}">
                    {{formatDate($date)}}
                </a>


            </h3>
            <h6 class="text-right"> {{ formatPrice(collect($orders_by_day[$date])->sum('total')) }}</h6>

            <div class="row">

                @if ($date == date('Y-m-d'))
                @isset($status[0])
                @if ($status[0]=="READY") <span class="badge badge-success d-block">Ordine pronto</span>@endif
                @if ($status[0]=="INCOMPLETE") <span class="badge badge-warning d-block">Ordine pronto ma
                    incompleto</span>@endif
                @endisset
                @endif
            </div>
        </div>

        <div id="data-{{$date}}" class="collapse {{ $date == date('Y-m-d') ? 'show': '' }} "
            data-parent="#student-accordion">
            <div class="card-body">

                <table class="table table-sm table-striped">

                    <thead>
                        <tr>
                            <th>Prodotto</th>
                            <th class="text-right">Quantità</th>
                            <th class="text-right">Totale</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($orders_by_day[$date] as $product)
                        <tr>
                            <td>{{ $product->name }}</td>

                            <td class="text-right">
                                <span class="badge badge-primary">
                                    {{ $product->quantity }}
                                </span>
                            </td>

                            <td class="text-right">{{ formatPrice($product->total) }}</td>
                        </tr>
                        @endforeach

                    </tbody>

                    <tfoot>
                        <tr class="table-primary">

                            <td class="text-left" colspan="2">

                                @timecheck

                                {{-- Visualizza il pulsante cancella solo nella data odierna e nel time-range
                                dell'ordine --}}
                                @if ($date == date('Y-m-d'))
                                <button class="btn btn-danger" href="javascript:;"
                                    onclick="deleteOrder('{{ route('order.delete') }}')">
                                    <i class=" fas fa-trash"></i> Cancella ordine
                                </button>

                                {{-- Visualizza il pulsante 'acquista di nuovo' solo nel time-range consentito ma in
                                giorni diversi da quello odierno--}}
                                @else

                                <button class="btn btn-success" href="javascript:;"
                                    onclick="reBuy('{{ $date }}')">
                                    <i class="fas fa-cart-plus"></i> Acquista di nuovo
                                </button>
                                @endif

                                @endtimecheck
                            </td>

                            <td class="text-right">
                                Totale: <b>{{ formatPrice(collect($orders_by_day[$date])->sum('total')) }}</b>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @endforeach
</div>


<div class="text-right">
    <h4>Totale ordini: <b>{{ formatPrice(collect($orders_by_day)->collapse('total')->sum('total')) }}</b></h4>
</div>

<div class="w-100 pl-2">
    {!! $orders->links() !!}
</div>

<script>
    function deleteOrder(url){

        Swal.fire({
            title: 'Sei sicuro di voler cancellare l\'ordine?',
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
                    success: (deletedOrder) => {
                        location.href = "student-orders?del=true";
                    },
                    error: (error) => {
                        toastr.error('Impossibile cancellare questo ordine');
                    }
                })
            }
        });
    }

    function reBuy(rowDate){
        $.ajax({
            url: '{{ route("order.rebuy") }}',
            method: 'POST',
            data: {
                orderDate: rowDate,
            },
            success: function () {
                location.href = '{{route("cart.checkout")}}';
            },
            error: function(error) {
                toastr.error('Si è verificato un errore: ' + error);
            }
        });
    }
</script>
@endsection

@push('js')

@include('partials._cartjs')

@endpush