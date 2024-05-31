<?php

/**
 * File:	/app/Http/Controllers/OrderController.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	February 27th, 2021 12:06pm
 * -----
 * Last Modified: 	March 31th 2024 20:03:03 pm
 * Modified By: 	Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * -----
 * HISTORY:
 * Date      	By           	Comments
 * ----------	-------------	----------------------------------
 * 2024-05-31   R. Andriano     rebuy Feature (completed)
 * 2022-12-03   C. Vaira        rebuy Feature (partial)
 * 2022-10-20	G. Giorgio	    1.1 deleteOrder
 * 2021-05-21	R. Andriano	    Order Status message
 * 2022-04-27	R. Andriano	    Orders-byStudente pagination
 * 2021-04-10	R. Andriano	    getOrdersOfTodayByClass getOrderbyStudent
 * 2021-03-01	G. Ciriello	    General improvements
 * 2021-03-01	G. Ciriello	    GetOrders (laravel method)
 * 2021-02-27   G. Ciriello	    First release
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
<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    /**
     * getOrdersByDay
     * Prepare the view Today's Order
     * 
     * CALLED BY BAR MANAGER
     *
     * @access	public
     * @param	mixed	$date	Default: null
     * @return	mixed
     */
    public function getOrdersByDay($date = null)
    {
        $date = $date ?: now()->toDateString();
        $site_id = auth()->user()->site->id;

        $orders = DB::table('orders')
            ->join('order_product', 'id', '=', 'order_id')
            ->join('products', 'product_id', '=', 'products.id')
            ->join('users', 'user_id', '=', 'users.id')
            ->join('classes', 'class_id', '=', 'classes.id')
            ->select(
                'class_id',
                'status',
                DB::raw('CONCAT(year,course,"-", section) as class_name'),
                'products.id',
                'products.name',
                DB::raw('SUM(quantity) as quantity'),
                DB::raw('SUM(order_product.price * order_product.quantity) as total')
            )
            ->where('users.site_id', $site_id)
            ->whereDate('orders.created_at', $date)
            ->groupBy('class_id', 'product_id')
            ->get();

        //Sort by class_name and product_name
        $orders = $orders->SortBy([
            ['class_name', 'asc'],
            ['name', 'asc']
        ]);

        //Group orders by class
        $classes = $orders->groupBy('class_id')->toArray();

        return view('pages.orders.orders-by-day', compact('classes', 'date'));
    }

    /**
     *  getProductsByDay
     *  Prepare the view Orders by product
     * 
     *  CALLED BY BAR MANAGER
     *
     * @access	public
     * @param	mixed	$date	Default: null
     * @return	mixed
     */
    public function getProductsByDay($date = null)
    {
        $date = $date ?: now()->toDateString();
        $site_id = auth()->user()->site->id;

        // Get all today's orders
        $products = DB::table('orders')
            ->join('order_product', 'id', '=', 'order_id')
            ->join('products', 'product_id', '=', 'products.id')
            ->join('users', 'user_id', '=', 'users.id')
            ->select(
                'products.id',
                'products.name',
                'order_product.price',
                'num_items',
                'default_daily_stock',
                DB::raw('SUM(quantity) as quantity'),
                DB::raw('SUM(order_product.price * order_product.quantity) as total')
            )
            ->where('users.site_id', $site_id)
            ->whereDate('orders.created_at', $date)
            ->groupBy('product_id')
            ->orderBy('name', 'asc')
            ->get();


        //dd($products);        

        return view('pages.orders.products-by-day', compact('products', 'date'));
    }


    /**
     * getOrdersOfTodayByClass()
     *
     * CALLED BY STUDENT 
     * Retrieve today's orders in the classroom of the connected student
     * 
     * @access	public
     * @return	mixed
     */
    public function getOrdersOfTodayByClass()
    {
        $class_id = auth()->user()->class->id;
        $class_name = auth()->user()->class->name;
        $date = date('Y-m-d');

        $orders = DB::table('orders')
            ->join('order_product', 'id', '=', 'order_id')
            ->join('products', 'product_id', '=', 'products.id')
            ->join('users', 'user_id', '=', 'users.id')
            ->select(
                'user_id',
                'users.last_name',
                'users.first_name',
                'products.id',
                'products.name',
                DB::raw('SUM(quantity) as quantity'),
                DB::raw('SUM(order_product.price * order_product.quantity) as total')
            )
            ->whereDate('orders.created_at', $date)
            ->where('class_id', $class_id)
            ->groupBy('user_id', 'product_id')
            ->get();

        //Sort by last_name and first_name
        $orders = $orders->SortBy([
            ['last_name', 'asc'],
            ['first_name', 'asc']
        ]);

        //Group orders by user
        $orders = $orders->groupBy('user_id')->toArray();

        //Retrieve the STATUS of the class orders starting from a possible user order
        //If the user has not placed any orders, he will not be able to view the status
        $status = Order::select('status')
            ->where('user_id', auth()->user()->id)
            ->whereDate('created_at', date('Y-m-d'))
            ->get()
            ->pluck('status');

        return view('pages.orders.orders-by-class', compact('status', 'orders', 'class_name'));
    }

    /**
     * getOrdersByStudent()
     *
     * CALLED BY STUDENT 
     * Retrive the connected user's orders
     *
     * @access	public
     * @return	mixed
     */
    public function getOrdersByStudent()
    {
        $user_id = auth()->user()->id;

        //Retrieve the user's orders by date and product
        $orders = DB::table('orders')
            ->join('order_product', 'id', '=', 'order_id')
            ->join('products', 'product_id', '=', 'products.id')
            ->select(
                DB::raw('DATE(orders.created_at) as date_order'),
                'products.id',
                'products.name as name',
                DB::raw('SUM(quantity) as quantity'),
                DB::raw('SUM(order_product.price * order_product.quantity) as total')
            )
            ->where('user_id', $user_id)
            ->groupBy('date_order', 'products.id')
            ->orderBy('date_order', 'desc')
            ->paginate(30);

        //Group orders by date
        $orders_by_day = $orders->groupBy('date_order');
        
        //Retrieve the STATUS of the class orders starting from a possible user order
        $status = Order::select('status')
            ->where('user_id', $user_id)
            ->whereDate('created_at', date('Y-m-d'))
            ->get()
            ->pluck('status');
        return view('pages.orders.orders-by-student', compact('status', 'orders', 'orders_by_day'));
    }

    /**
     * setOrderStatus.
     * CALLED BY MANAGER 
     * 
     * Update all orders STATUS in a class
     * @access	public
     * @param	request	$request	
     * @return	void
     */
    public function setOrderStatus(Request $request)
    {
        $class_id = $request->input('class_id');
        $status = $request->input('status');
        if ($status == 'READY' or $status == 'INCOMPLETE') {
            $orders = Order::join('users', 'users.id', '=', 'user_id')
                ->where('class_id', $class_id)
                ->whereDate('orders.created_at', date('Y-m-d'))
                ->update(['status' => $status]);
        }
    }

    /**
     * deleteOrder
     * CALLED BY STUDENT
     * 
     * Delete today's order placed by connected user
     * @access	public
     * @return	void
     */
    public function deleteOrder()
    {
        $date = date('Y-m-d');
        $user = auth()->user()->id;

        //Retrive list of ordered products
        $order_product = DB::table('order_product')
            ->join('orders', 'order_id', '=', 'orders.id')
            ->where('user_id', $user)
            ->whereDate('orders.created_at', $date)
            ->get();

        //For each ordered product, restore the stock quantity
        foreach ($order_product as $item) {
            $product = Product::find($item->product_id);
            $product->increment('num_items', $item->quantity);
        }


        //Delete all products ordered today by the user
        $order_product = DB::table('order_product')
            ->join('orders', 'order_id', '=', 'orders.id')
            ->where('user_id', $user)
            ->whereDate('orders.created_at', $date)
            ->delete();

        //Delete all orders of the day by the user
        $orders = Order::where('user_id', $user)
            ->whereDate('created_at', $date)
            ->delete();
    }

    /**
     * rebuyOrder
     * CALLED BY STUDENT
     * 
     * Reorder the products ordered in a day and put them in the cart
     * @access	public
     * @param	request	$request
     * @return	void
     */
    public function rebuyOrder(Request $request)
    {
        $date = $request->input('orderDate');
        $user = auth()->user()->id;

        //Retrieve the ordered products for the date from the user
        $order_product = DB::table('order_product')
            ->join('orders', 'order_id', '=', 'orders.id')
            ->where('user_id', $user)
            ->whereDate('orders.created_at', $date)
            ->get();
        
        //Retrieve session variables
        $cart=session()->get('cart');
        $categ=session()->get('categ');

        //foreach product insert it into the cart
        foreach ($order_product as $item) {
            $product_id = $item->product_id;
            $product_quantity = $item->quantity;
            $categ_id= Product::find($product_id)->category_id;
            
            //update cart session variable
            if(isset($cart[$product_id])){
                $cart[$product_id]+=$product_quantity;
            } else{
                $cart[$product_id]=$product_quantity;
            } 
            
            //update categ session variable
            if(isset($categ[$categ_id])){
                $categ[$categ_id]+=$product_quantity;
            } else{
                $categ[$categ_id]=$product_quantity;
            } 
        }
        //store session variable
        session(['cart' => $cart]);
        session(['categ' => $categ]);
    }
        
}
