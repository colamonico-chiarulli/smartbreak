<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CartController extends Controller
{
    public function chooseProducts()
    {
        $categories = Category::with('products')->get();
        return view('pages.home', compact('categories'));
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

        return response()->json($this->getCart());
    }


    public function getCart()
    {
        $product_ids = collect(session()->get('cart'))->keys();
        $products = Product::whereIn('id', $product_ids)->get();

        return [
            'cart' => session('cart'),
            'total' => $products->sum(function ($product) {
                return $product->price * session('cart.'.$product->id);
            })
        ];
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
        $cart_items = session('cart');

        // Controllare che ogni prodotto selezionato abbia una quantità minore o uguale di quella disponibile
        $unavaiable_products = [];
        foreach ($cart_items as $product_id => $product_quantity) {
            $product = Product::find($product_id);

            if ($product_quantity > $product->num_items) {
                $unavaiable_products[] = [$product_id => $product->num_items];
            }
        }

        // Restituire all'utente un errore contenente il messaggio: Non ci sono abbastanza unità per questo prodotto.
        if (count($unavaiable_products) > 0) {
            return response()->json([
                'success' => false,
                'unavailability_products' => $unavaiable_products
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
