<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(8);
        return view('pages.products2.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 8);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        //        return view('products.create', compact('categories'));

        return view('pages.products2.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validare i dati di input
        $request->validate([
            "name" => ["required"],
            "description" => ["required"],
            "price" => ["required", "numeric"],
            "num_items" => ["required", "numeric"],
            "default_daily_stock" => ["numeric"],
            "category_id" => ["required"],
        ]);
        Product::create($request->all());
        return redirect()->route('products.index')
            ->with('success', 'Prodotto aggiunto.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $categories = Category::all();
        return view('pages.products2.show', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('pages.products2.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            "name" => ["required"],
            "description" => ["required"],
            "price" => ["required", "numeric"],
            "num_items" => ["required", "numeric"],
            "default_daily_stock" => ["numeric"],
            "category_id" => ["required"],
        ]);
        $product->update($request->all());
        return redirect()->route('products.index')
            ->with('success', 'Prodotto aggiornato!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'Prodotto cancellato!');
    }

    /**
     * Display the specified resource for delete confimation
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Product $product)
    {
        $categories = Category::all();
        return view('pages.products2.delete', ['product' => $product, 'categories' => $categories]);
    }
}