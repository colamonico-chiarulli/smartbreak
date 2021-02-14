<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function editCart()
    {

        $product_index = 'cart.'.request()->product_id;
        $product_quantity = request()->quantity;

        if($product_quantity == 0){
            session()->pull($product_index);
        }else{
            session()->put($product_index, $product_quantity);
        }

        return;

    }

    public function emptyCart()
    {
        session()->pull('cart');

        return;

    }

    public function checkoutCart()
    {

        $product_ids = collect(session()->get('cart'))->keys();
        $products = Product::whereIn('id', $product_ids)->get();

        return view("pages.checkout", compact('products'));
    }

    public function createOrder()
    {

        // Controllare che ogni prodotto selezionato abbia una quantità minore o uguale di quella disponibile

        // Creazione di un nuovo ordine con la lista dei prodotti scelti

        // Aggiornare la quantità di prodotti disponibile

    }
}
