<?php
/**
 * File:	/resources/views/pages/orders/orders-by-class.blade.php
 * @package smartbreak
 * @author  Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: Friday, April 9th 2021, 9:19:53 pm
 * -----
 * Last Modified: 	April 30th 2021 9:21:27 pm
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

@extends('layouts.app', ['title' => 'Ordini della Classe '. $class_name])

@section('content')

@isset($status[0])
    <h3>
    @if ($status[0]=="READY") <span class="badge badge-success d-block">Ordine pronto</span>@endif
    @if ($status[0]=="INCOMPLETE") <span class="badge badge-warning d-block">Ordine pronto ma incompleto</span>@endif
    </h3>
@endisset

<div id="class-accordion">
@foreach($orders as $user=>$order)
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title w-75 text-bold"> 
                <a class="d-block w-75 collapsed" data-toggle="collapse" href="#user-{{$user}}">
                    {{ $orders[$user][0]->last_name}} {{ $orders[$user][0]->first_name }}
                </a>
            </h3>
            <h6 class="text-right"> {{ formatPrice(collect($orders[$user])->sum('total')) }}</h6>
            {{-- <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div> --}}
        </div>

        <div id="user-{{$user}}" class="collapse" data-parent="#class-accordion">
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

                        @foreach($orders[$user] as $product)
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
                            <td class="text-right" colspan="3">
                                Totale: <b>{{ formatPrice(collect($orders[$user])->sum('total')) }}</b>
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
    <h4>Totale classe: <b>{{ formatPrice(collect($orders)->collapse('total')->sum('total')) }}</h4> 
</div>


@endsection
