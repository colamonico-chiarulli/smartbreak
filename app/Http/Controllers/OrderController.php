<?php
/**
 * File:	/app/Http/Controllers/OrderController.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	February 27th, 2021 12:06pm
 * -----
 * Last Modified: 	April 12th 2021 7:48:30 pm
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
 * "(C) IISS Colamonico-Chiarulli-https://colamonicochiarulli.it - 2021".
 *
 * ------------------------------------------------------------------------------
 */

?>
<?php

namespace App\Http\Controllers;

use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    // CALLED BY BAR MANAGER
    public function getOrdersByDay($date = null)
    {
        $date = $date ?: now()->toDateString();

        // Prendo tutti gli ordini di oggi
        $classes = $this->getOrders(null, $date);

        return view('pages.orders.orders-by-day', compact('classes', 'date'));
    }

    // CALLED BY BAR MANAGER
    public function getProductsByDay($date = null)
    {
        $date = $date ?: now()->toDateString();

        // Prendo tutti gli ordini di oggi
        $products = Order::with('products')->whereDate('created_at', $date)
            ->get()
            ->pluck('products') // Per ogni classe, prendo solo i prodotti degli ordini
            ->collapse() // Unisco tutti i prodotti ordinati in un unico array
            ->groupBy('id')->map(function ($gruped_products) { // Raggruppo i prodotti per id

                $quantity = $gruped_products->sum('pivot.quantity');

                return [
                    'product' => collect($gruped_products->first())->forget('pivot'), // Qui salvo le informazioni del prodotto
                    'quantity' => $quantity,            // Qui salvo la quantità ordinata del prodotto
                    'price' => $gruped_products->first()->pivot->price * $quantity
                ];
            })->values();

        return view('pages.orders.products-by-day', compact('products', 'date'));
    }


    private function getOrders($class_id = null, $date)
    {
        $data = Order::with('products', 'user')->whereDate('created_at', $date);
        


        if ($class_id) {
            $data->whereHas('user', function (Builder $query) use ($class_id) {
                $query->where('class_id', $class_id);
            });
        }

        $data = $data->get()
            ->groupBy('user.class_id') // Raggruppo gli ordini in base alla classe
            ->map(function ($grouped_order) {
                return [
                    'class' => $grouped_order->first()->user->class,
                    'products' =>  $grouped_order
                        ->pluck('products') // Per ogni classe, prendo solo i prodotti degli ordini
                        ->collapse() // Unisco tutti i prodotti ordinati in un unico array
                        ->groupBy('id')->map(function ($gruped_products) { // Raggruppo i prodotti per id

                            $quantity = $gruped_products->sum('pivot.quantity');

                            return [
                                'product' => collect($gruped_products->first())->forget('pivot'), // Qui salvo le informazioni del prodotto
                                'quantity' => $quantity,            // Qui salvo la quantità ordinata del prodotto
                                'price' => $gruped_products->first()->pivot->price * $quantity
                            ];
                        })->values()
                ];
            })->values();

        return $data;
    }

    
    /**
     * getOrdersOfTodayByClass()
     *
     * CALLED BY STUDENT 
     * Recupera gli ordini del giorno effettuati nella classe dello studente connesso
     *
     * @access	public
     * @return	mixed
     */
    public function getOrdersOfTodayByClass()
    {
        $class_id = auth()->user()->class->id;
        $class_name= auth()->user()->class->name; 
        $date = date('Y-m-d');
        
        $orders = DB::table('orders')
                ->join('order_product', 'id', '=', 'order_id')
                ->join('products', 'product_id', '=', 'products.id')
                ->join('users', 'user_id', '=', 'users.id')
                ->select('user_id', 'users.last_name', 'users.first_name', 'products.id', 'products.name', 
                         DB::raw('SUM(quantity) as quantity'),
                         DB::raw('SUM(order_product.price * order_product.quantity) as total')
                         )
                ->whereDate('orders.created_at', $date)
                ->where('class_id', $class_id)
                ->groupBy('user_id', 'product_id')
                ->get(); //TODO: Eventuale paginazione
  
        //Ordina per cognome e nome
        $orders = $orders->SortBy([
            ['last_name','asc'],
            ['first_name','asc']
        ]);
        
        //Raggruppa gli ordini per utente
        $orders=$orders->groupBy('user_id')->toArray(); 
        
        return view('pages.orders.orders-by-class', compact('orders','class_name'));
    }

    /**
     * getOrdersByStudent()
     *
     * CALLED BY STUDENT 
     * Recupera gli ordini dello studente connesso
     *
     * @access	public
     * @return	mixed
     */
    public function getOrdersByStudent()
    {
        $user_id = auth()->user()->id;
        
        //recupara gli ordini dell'utente per data e prodotto
        $orders = DB::table('orders')
                ->join('order_product', 'id', '=', 'order_id')
                ->join('products', 'product_id', '=', 'products.id')
                ->select(DB::raw('DATE_FORMAT(DATE(orders.created_at), "%d-%m%-%Y") as date_order'),
                        'products.id', 'products.name as name', 
                         DB::raw('SUM(quantity) as quantity'),
                         DB::raw('SUM(order_product.price * order_product.quantity) as total')
                         )
                ->where('user_id', $user_id)
                ->groupBy('date_order','products.id')
                ->orderBy('date_order', 'desc')
                ->get();
        
        //raggruppa gli ordini per data
        $orders=$orders->groupBy('date_order');
                       
        return view('pages.orders.orders-by-student', compact('orders'));
    }
}


