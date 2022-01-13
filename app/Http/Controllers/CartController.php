<?php
/**
 * File:	/app/Http/Controllers/CartController.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	February 6th, 2021 7:01pm
 * -----
 * Last Modified: 	January 13th 2022 5:07:22 pm
 * Modified By: 	Rino Andriano <andriano@colamonicochiarulli.it>
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
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

/**
 * CartController.
 *
 * @author	Giovanni Ciriello
 * @since	v0.0.1
 * @version	v1.0.1	Thursday, January 13th, 2022. - Rino Andriano
 *          BUG Fixed - Cart must have only products with num_items > 0
 * @see		Controller
 * @global
 */
class CartController extends Controller
{
    public function chooseProducts()
    {
        $search_name = request()->search_name;

        $categories = Category::with(['products' => function ($query) use ($search_name) {
            $query->where('site_id', auth()->user()->site_id)
                ->where('name', 'like', '%'.$search_name.'%')
                ->where('num_items','>',0)
                ->orderBy('name');
        }])->orderBy('name')->get();

        return view('pages.cart.choose-products', compact('categories', 'search_name'));
    }

    public function editCart()
    {
        $product_index = 'cart.'.request()->product_id;
        $product_quantity = request()->quantity;

        if ($product_quantity == 0) {
            session()->pull($product_index);
        } else {
            session()->put($product_index, $product_quantity);
        }

        $category_index = 'categ.'.request()->category_id;
        $tot_category = request()->tot_category;
        session()->put($category_index, $tot_category);

        return response()->json($this->getCart());
    }


    public function getCart()
    {
        $product_ids = collect(session()->get('cart'))->keys();
        $products = Product::whereIn('id', $product_ids)->get();

        return [
            'categ' =>session('categ'),
            'cart' => session('cart'),
            'num_items' => collect(session('cart'))->sum(),
            'total' => $products->sum(function ($product) {
                return $product->price * session('cart.'.$product->id);
            })
        ];
    }

    public function emptyCart()
    {
        session()->pull('cart');
        session()->pull('categ');

        return;
    }

    public function checkoutCart()
    {
        $product_ids = collect(session()->get('cart'))->keys();
        $products = Product::whereIn('id', $product_ids)->get();

        return view("pages.cart.checkout", compact('products'));
    }

    public function createOrder()
    {
        $cart_items = session('cart');

        // Controllare che ogni prodotto selezionato abbia una quantità minore o uguale di quella disponibile

        $over_max_units_messages = [];
        foreach ($cart_items as $product_id => $product_quantity) {
            $product = Product::find($product_id);

            $max_units_ordable = min($product->num_items, config('smartbreak.max_units_ordable'));

            if ($product_quantity > $max_units_ordable) {
                $over_max_units_messages[] = "Non puoi ordare più di <b>{$max_units_ordable}</b> unità del prodotto <b>{$product->name}</b>";
            }
        }

        if (count($over_max_units_messages) > 0) {
            return response()->json([
                'success' => false,
                'error_msgs' => $over_max_units_messages
            ]);
        }

        // ✅ Creazione di un nuovo ordine con la lista dei prodotti scelti
        // ✅ Aggiornare la quantità di prodotti disponibile
        $order = auth()->user()->orders()->create();

        foreach ($cart_items as $product_id => $product_quantity) {
            $product = Product::find($product_id);

            $order->products()->attach([ $product_id => [
                'quantity' => $product_quantity,
                'price' => $product->price
            ]]);

            $product->decrement('num_items', $product_quantity);
        }

        return response()->json([
            'success' => true
        ]);
    }
}
