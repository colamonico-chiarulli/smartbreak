<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Site;
use Illuminate\Http\Request;
use Storage;

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
        $sites = Site::all();
        return view('pages.products.create', compact('categories', 'sites'));
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
        $request->validate(Product::validationRules());

        $product = Product::create($request->all());

        if(request()->photo){
            Storage::move('temp/'.request()->photo,'img/products/'.request()->photo);
            $product->update(['photo_path' => request()->photo]);
        }

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
        $sites = Site::all();
        return view('pages.products.show', compact('product', 'categories', 'sites'));
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
        $sites = Site::all();
        return view('pages.products.edit', compact('product', 'categories', 'sites'));
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

        $request->validate(Product::validationRules());

        //dd(request()->all());

        if(request()->photo){
            Storage::move('temp/'.request()->photo,'img/products/'.request()->photo);
            $product->update(['photo_path' => request()->photo]);
        }

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

        return $product;
    }
}
