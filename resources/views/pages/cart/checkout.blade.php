<?php
/**
 * File:	/resources/views/pages/checkout.blade.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	February 14th, 2021 5:49pm
 * -----
 * Last Modified: 	April 19th 2021 1:12:41 pm
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
@extends('layouts.app', ['title' => 'Riepilogo ordine'])

@section('content')
<div class="col-12 col-md-3 my-3 text-right">
    <a class="text-danger" href="javascript:;" onclick="emptyCartRefresh()">
        <i class="fa fa-cart-arrow-down"></i> Svuota carrello
    </a>
</div>
@if(session('categ') !== NULL)
    @foreach (session('categ') as $category=>$value)
        <span id="category-item-{{ $category }}" style="display:none">{{ $value }}</span>
    @endforeach    
@endif

@forelse($products as $product)
    @include('partials._product-card', ['product' => $product])
    @empty
    <p class="text-center text-muted">🛒 &nbsp;Il carrello è al momento vuoto. <a href="{{ route('home') }}">Vai alla
            home</a></p>
@endforelse

@if($products->count() > 0)
<div class="text-right mb-3">
    <h4 class="my-4">Totale carrello: <b class="cart-total"></b></h4>
    <a href="{{ route("cart.choose-products") }}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Aggiungi altro
    </a>
    <button class="btn btn-success" onclick="createOrder()">
        <i class="fa fa-check"></i> Conferma ordine
    </button>
</div>
@endif

@endsection

@push('js')

    @include('partials._cartjs', ['products' => $products->keyBy('id')])

    <script>
        function createOrder(){

            $.post('{{ route('cart.create-order') }}', function(res){
                if(res.success){
                    emptyCart(function(){
                        window.location.href = '{{ route("cart.choose-products") }}?ck=true';
                    });
                }else{
                    res.error_msgs.forEach(error_msg => {
                        toastr.error(error_msg);
                    })
                }
            });
        }
    </script>

@endpush
