<?php
/**
 * File:	/resources/views/pages/cart/choose-products.blade.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	December 15th, 2020 11:05pm
 * -----
 * Last Modified: 	November 9th 2022 09:39:29 pm
 * Modified By: 	Gabriele Losurdo <gabriele.losurdo.inf@colamonicochiarulli.edu.it>
 * -----
 * HISTORY:
 * Date      	By           	Comments
 * ----------	-------------	----------------------------------
 * 2022-11-09	G. Losurdo  	1.1 Price-list / Place an order feature
 * 2022-01-07	R. Andriano	    Add images disclaimer text
 * 2021-04-15	R. Andriano	    New: Total items by category in choose-products
 * 2021-04-11	G. Ciriello     Product search
 * 2021-01-24	R. Andriano     Added toastr notification
 * 2021-01-09	G. Ciriello     ui improvements in product card
 * 2020-12-21	G. Ciriello     Product view
 * 2020-12-15	G. Ciriello     Init project	
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

@extends('layouts.app', ['title' => $title])

@section('content')

<div class="row justify-content-between mb-2">


    <div class="col-12 col-md-3 d-flex align-items-center">
        <form action="{{ route('cart.choose-products') }}">
            <div class="input-group  input-group-sm">
                <input name="search_name" type="text" class="form-control" value="{{ $search_name }}" placeholder="Cerca prodotto..">
                <span class="input-group-append">
                    <a href="{{ route('cart.choose-products') }}" type="submit" class="btn btn-danger btn-flat">
                        <i class="fas fa-times"></i>
                    </a>
                </span>
                <span class="input-group-append">
                    <button type="submit" class="btn btn-info btn-flat">
                        <i class="fas fa-search"></i>
                    </button>
                </span>

            </div>
        </form>
    </div>

@timecheck
    <div class="col-12 col-md-3 my-3 text-right">
        <a class="text-danger" href="javascript:;" onclick="emptyCartRefresh()">
            <i class="fa fa-cart-arrow-down"></i> Svuota carrello
        </a>
    </div>
@endtimecheck
</div>


<div id="categories-accordion">
@foreach($categories as $category)
    @if($category->products->count())
    <div class="card card-default">
        <div class="card-header">
            <h4 class="card-title w-75">
                <a class="d-block w-75 collapsed" data-toggle="collapse" href="#category-{{ $category->id }}">
                    {{ $category->name }} <small class="text-muted">{{ $category->products->count() }} prodotti</small>
                </a>
            </h4>
            @timecheck
                <div class="text-right"> 
                    🛒<span id="category-item-{{ $category->id }}" class="badge badge-info">0</span>
                </div>
            @endtimecheck
        </div>
        {{-- tab apert: {{ $loop->first ? 'show' : 'collapse' }} --}}
        <div id="category-{{ $category->id }}" class="collapse" data-parent="#categories-accordion">
            <div class="card-body">
                @each('partials._product-card', $category->products, 'product')
            </div>
            <div class="card-body mt-0 pt-0 small text-muted">Le immagini sono inserite a scopo illustrativo e potrebbero non corrispondere al prodotto</div>
        </div>
    </div>
    @endif
@endforeach
</div>

@timecheck
<div class="text-center">
    <a class="btn btn-lg btn-success my-4" href="{{ route('cart.checkout') }}">
        <i class="fa fa-shopping-cart"></i> Vai al riepilogo
    </a>
</div>
@endtimecheck

@endsection

@push('js')

    @include('partials._cartjs', ['products' => $categories->pluck('products')->collapse()->keyBy('id')])

@endpush
