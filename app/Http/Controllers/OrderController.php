<?php

namespace App\Http\Controllers;

use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

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


    // CALLED BY STUDENT
    public function getOrdersOfTodayByClass()
    {
        $class_id = auth()->user()->class->id;

        $classes = $this->getOrders($class_id);

        return view('pages.orders.orders-by-day', compact('classes'));
    }
}
