<?php

namespace App\Http\Controllers;

use App\Models\Order;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getOrdersOfToday()
    {

        // Prendo tutti gli ordini di oggi
        $orders = Order::with('products', 'user')
            ->whereDate('created_at', now()->toDateString())
            ->get()
            ->groupBy('user.class_id') // Raggruppo gli ordini in base alla classe
            ->map(function ($grouped_order) {
                return [
                    'class' => $grouped_order->first()->user->class,
                    'products' =>  $grouped_order
                        ->pluck('products') // Per ogni classe, prendo solo i prodotti degli ordini
                        ->collapse() // Unisco tutti i prodotti ordinati in un'unico array
                        ->groupBy('id')->map(function ($gruped_products) { // Raggruppo i prodotti per id
                            return [
                                'product' => collect($gruped_products->first())->forget('pivot'), // Qui salvo le informazioni del prodotto
                                'quantity' => $gruped_products->sum('pivot.quantity')              // Qui salvo la quantità ordinata del prodotto
                            ];
                        })->values()
                ];
            })->values();

        return view('pages.today-orders', compact('orders'));
    }
}
