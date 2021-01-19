<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

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

        $categories = Category::all();

        return view('pages.products.products-create', ['categories' => $categories]);

    }

    // crea un nuovo prodotto
    public function store(Request $request)
    {

        // validare i dati di input
        $this->validate($request, [
            "name" => ["required"],
            "description" => ["required"],
            "allergens" => [],
            "price" => ["required", "numeric"],
            "num_items" => ["required", "numeric"],
            "num_daily_stock" => ["numeric"],
        ]);

        echo "prodotto inserito";

        // inserire il prodotto nel database

    }

}
