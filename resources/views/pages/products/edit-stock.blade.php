<?php
/**
 * File:	/resources/views/pages/products/edit-stock.blade.php
 * @package smartbreak
 * @author  Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: Thursday, May 6th 2021, 4:44:10 pm
 * -----
 * Last Modified: 	May 6th 2021 8:19:07 pm
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
@extends('layouts.app', ['title' => 'Modifica Giacenze'])

@section('content')

<div id="categories-accordion">
    @foreach($categories as $category)
    @if($category->products->count())
    <div class="card card-default">
        <div class="card-header">
            <h4 class="card-title w-100">
                <a class="d-block w-100 collapsed" data-toggle="collapse" href="#category-{{ $category->id }}">
                    {{ $category->name }} <small class="text-muted">{{ $category->products->count() }} prodotti</small>
                </a>
            </h4>
        </div>
        {{-- tab apert: {{ $loop->first ? 'show' : 'collapse' }} --}}
        <div id="category-{{ $category->id }}" class="collapse" data-parent="#categories-accordion">
            <div class="card-body">
                @each('pages.products._product-detail', $category->products, 'product')
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>


@endsection

@push('js')

<script>
    function saveProduct(id, button){
        var num_items = $("#product-stock-"+id).val();
        var default_daily_stock = $("#product-daily-"+id).val();
        $.ajax({
            url: '{{ route("products.set-stocks") }}',
            method: "POST",
            data: {
                id,
                num_items,
                default_daily_stock,
            },
            success: function name(result) {
                toastr.success('Giacenza aggiornata!');

                if(button == 'stock'){
                    $("#btn-stock-"+id).removeClass('btn-secondary');                        
                    $("#btn-stock-"+id).addClass('btn-success');
                } else {
                    $("#btn-daily-"+id).removeClass('btn-secondary');                        
                    $("#btn-daily-"+id).addClass('btn-success');                    
                }
            },

        });
    }

</script>

@endpush