<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
