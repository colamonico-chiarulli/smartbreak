<?php
/**
 * File:	/resources/views/partials/_product-card.blade.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	February 2nd, 2020 11:05pm
 * -----
 * Last Modified: 	April 15th 2021 4:45:30 pm
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

            <div class="my-2 d-flex justify-content-between align-items-center">

                <p class="my-auto">
                    <span class="badge badge-primary">
                        {{ $product->formatted_price }}
                    </span>
                </p>

                <div class="text-right">
                    <div class="input-group input-group-sm" style="max-width: 90px;">
                        <span class="input-group-prepend">
                            <button type="button" class="btn btn-primary btn-flat"
                                    onclick="editCart({{ $product->category_id}},{{ $product->id }}, -1)"> - </button>
                        </span>
                        <input type="number" class="form-control noarrows text-center cart-product-items"
                               id="product-items-{{ $product->id }}"
                               value="{{ session('cart.'.$product->id) ?? 0 }}" disabled >
                        <span class="input-group-append">
                            <button type="button" class="btn btn-primary btn-flat"
                                    onclick="editCart({{ $product->category_id}},{{ $product->id }}, 1)"> + </button>
                        </span>
                    </div>
                    <small>
                        Tot.
                        <b id="product-total-{{ $product->id }}" class="cart-product-totals">
                            {{ formatPrice($product->price * session('cart.'.$product->id)) }}
                        </b>
                    </small>
                </div>
            </div>

            @if($product->num_items < 2)
              <small class="text-danger mt-2">
                <i class="fas fa-exclamation-triangle"></i>
                Disponibilità limitata
                </small>
            @endif

        </div>
    </div>
</div>
