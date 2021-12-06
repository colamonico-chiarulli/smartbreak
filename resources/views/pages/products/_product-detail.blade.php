<?php
/**
 * File:	/resources/views/pages/products/_product-detail.blade.php
 * @package smartbreak
 * @author  Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: Thursday, May 6th 2021, 5:07:41 pm
 * -----
 * Last Modified: 	May 6th 2021 7:34:44 pm
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
<div class="product">

    <div class="product-title m-2">
        <b>{{ $product->name }}</b>
        @if($product->allergens != "")
        <span data-toggle="tooltip" data-placement="right" title="Allergeni: {{ $product->allergens }}">
            <span class="fa-stack" style="font-size: 12px">
                <i class="far fa-circle fa-stack-2x text-success"></i>
                <i class="fas fa-leaf fa-stack-1x text-success"></i>
            </span>
        </span>
        @endif
    </div>


    <div class="product-content d-flex">
        <div class="product-image d-flex align-items-center">
            <img src="{{ $product->getFirstMediaUrl('product_photo') }}" class="img-fluid" height="">
        </div>


        <div class="product-info w-100 ml-2">
            <span class="text-muted product-description">
                {{ $product->description }}
            </span>

            <div class="my-2 d-flex justify-content-around align-items-center">

                <p class="my-auto">
                    <span class="badge badge-primary">
                        {{ $product->formatted_price }}
                    </span>
                </p>

                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label>Quantità disponibile</label>
                        <div class="input-group input-group-sm" >
                            <input autocomplete="off" type="number" class="form-control text-center cart-product-items col-4"
                                id="product-stock-{{ $product->id }}" value="{{ $product->num_items }}">
                            <span class="input-group-append">
                                <button id="btn-stock-{{ $product->id }}" type="button" class="btn btn-secondary btn-flat" title="Salva"
                                    onclick="saveProduct({{ $product->id }},'stock')"> <i class="fas fa-check-circle"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label>Disponibilità quotidiana</label>
                        <div class="input-group input-group-sm">
                            <input autocomplete="off" type="number" class="form-control text-center cart-product-items col-4"
                                id="product-daily-{{ $product->id }}" value="{{ $product->default_daily_stock }}">
                            <span class="input-group-append">
                                <button id="btn-daily-{{ $product->id }}" type="button" class="btn btn-secondary btn-flat" title="Salva"
                                     onclick="saveProduct({{ $product->id }},'daily')"> <i class="fas fa-check-circle"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>