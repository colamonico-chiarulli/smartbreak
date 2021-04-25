<?php
/**
 * File:	/resources/views/pages/orders/orders-by-day.blade.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	March 15th, 2021 5:15pm
 * -----
 * Last Modified: 	
 * Modified By: 	
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
 * "(C) IISS Colamonico-Chiarulli-https://colamonicochiarulli.it - 2021".
 * 
 * ------------------------------------------------------------------------------
 */

?>
@extends('layouts.app', ['title' => 'Ordini del giorno '. formatDate($date)])

@section('content')

<div class="row">
    <div class="col-md-4 ml-auto">
        <div class="form-group">
            <label for="date">Visualizza gli ordini della data:</label>
            <div class="input-group">
                <input type="date" class="form-control" id="date" placeholder="Seleziona una data" value="{{ $date }}" max="{{ date('Y-m-d') }}">
                <span class="input-group-append">
                    <a
                       href="javascript:;"
                       onclick="location.href = '{{ route('orders.by-day') }}/'+document.getElementById('date').value"
                       class="btn btn-primary btn-flat" data-toggle="tooltip" title="Cerca ordini per data">
                        <i class="fas fa-search"></i>
                    </a>
                </span>
            </div>
        </div>
    </div>
</div>


@foreach($classes as $class)

<div id="accordion">
    <div class="card">
        <div class="card-header cursor-pointer" data-toggle="collapse" href="#class-{{ $class['class']->id }}">
            <h3 class="card-title text-bold" data-card-widget="collapse">{{ $class['class']->name }}</h3>

            {{-- <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div> --}}

        </div>

        <div class="show" id="class-{{ $class['class']->id }}">
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

                        @foreach($class['products'] as $product)
                        <tr>
                            <td>{{ $product['product']['name'] }}</td>

                            <td class="text-right">
                                <span class="badge badge-primary">
                                    {{ $product['quantity'] }}
                                </span>
                            </td>

                            <td class="text-right">{{ formatPrice($product['price']) }}</td>
                        </tr>
                        @endforeach

                    </tbody>

                    <tfoot>
                        <tr class="table-primary">
                            <td class="text-right" colspan="3">
                                Totale: <b>{{ formatPrice(collect($class['products'])->sum('price')) }}</b>
                            </td>
                        </tr>
                    </tfoot>


                </table>

            </div>
            <div class="card-footer">
                <button class="btn btn-success" data-card-widget="collapse" data-toggle="collapse" href="#class-{{ $class['class']->id }}">Ordine preparato</button>
            </div>

        </div>

    </div>
</div>

@endforeach

@endsection
