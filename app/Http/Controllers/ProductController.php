<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    // restituisce una pagina con i prodotti
    public function index(){

        $products = Product::all();

        return view('pages.products.products-list', ['products' => $products]);

    }


    // restituisce una pagina di creazione di un prodotto
    public function create()
    {

    }

}
