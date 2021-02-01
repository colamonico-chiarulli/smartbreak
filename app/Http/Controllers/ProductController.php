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

        return view('pages.products.index', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $formCategory = old('category_id') ?: null;
        return view('pages.products.create', compact('categories', 'formCategory'));
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
        $formCategory = $product->category_id;
        return view('pages.products.show', compact('product', 'categories', 'formCategory'));
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
        $formCategory = $product->category_id;
        return view('pages.products.edit', compact('product', 'categories', 'formCategory'));
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
        $formCategory = $product->category_id;
        return view('pages.products.delete', compact('product', 'categories', 'formCategory'));
    }
}
