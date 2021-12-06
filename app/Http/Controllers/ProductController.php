<?php
/**
 * File:	/app/Http/Controllers/ProductController.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	January 11th, 2021 5:00pm
 * -----
 * Last Modified: 	May 6th 2021 8:25:54 pm
 * Modified By: 	Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * -----
 * @license	https://www.gnu.org/licenses/agpl-3.0.html AGPL 3.0
 * ------------------------------------------------------------------------------
 * SmartBreak is a School Bar food booking web application
 * developed during the PON course "The AppFactory" 2020-2021 with teachers
 * & students of "Informatica e Telecomunicazioni"
 * at IISS "C. Colamonico - N. Chiarulli" Acquaviva delle Fonti (BA)-Italy
 * Expert dr. Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * ----------------------------------------------------------------------------
 * SmartBreak is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by
 * the Free Software Foundation
 *
 * SmartBreak is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * You should have received a copy of the GNU Affero General Public License along
 * with this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * The interactive user interfaces in original and modified versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the SmartBreak
 * logo and IISS "Colamonico-Chiarulli" copyright notice. If the display of the logo
 * is not reasonably feasible for technical reasons, the Appropriate Legal Notices
 * must display the words
 * "(C) IISS Colamonico-Chiarulli-https://colamonicochiarulli.edu.it - 2021".
 *
 * ------------------------------------------------------------------------------
 */

?>
<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Site;
use Illuminate\Http\Request;
use Storage;
use App\Models\TemporaryFile;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //recupera eventuale filtro sul nome prodotto
        $filter = $request->query('filter');

        //recupera site_id dell'utente
        $site = auth()->user()->site_id;

        if ($site) {
            $products = Product::sortable()
                ->where('site_id', $site)
                ->where('name', 'like', '%'.$filter.'%')
                ->orderBy('category_id', 'asc')
                ->orderBy('name', 'asc')
                ->paginate(8);
        } else { //Admin
            $products = Product::sortable()
                ->where('name', 'like', '%'.$filter.'%')
                ->orderBy('site_id', 'asc')
                ->orderBy('category_id', 'asc')
                ->orderBy('name', 'asc')
                ->paginate(8);
        }

        return view('pages.products.index', compact('products', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $sites = Site::orderBy('id', 'asc')->get();
        return view('pages.products.create', compact('categories', 'sites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product = null)
    {

        //Imposta la sede del prodotto
        if (!isset($request->site_id)) {
            $site = auth()->user()->site_id;
            $request->request->add(['site_id' => $site]);
        }

        // validare i dati di input
        $request->validate(Product::validationRules());


        if ($product) {
            $product->update($request->all());
        } else {
            $product = Product::create($request->all());
        }

        if (request()->photo) {
            $temporaryFile = TemporaryFile::where('folder', $request->photo)->first();
            if ($temporaryFile) {
                $product->clearMediaCollection('product_photo');
                $tmp_folder = storage_path("app/public/products/tmp/{$request->photo}");
                $product->addMedia("{$tmp_folder}/{$temporaryFile->filename}")->toMediaCollection('product_photo');
                rmdir($tmp_folder);
                $temporaryFile->delete();
            }
        }

        return redirect()->route('products.index')->with('success', 'Prodotto salvato');
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
        $sites = Site::orderBy('id', 'asc')->get();
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
        $sites = Site::orderBy('id', 'asc')->get();
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
        return $this->store($request, $product);
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

    /**
     * getStocks
     * 
     * Prepara la vista con Categorie->prodotti per la modifica delle giacenze
     *
     * @access	public
     * @return	void
     */
    public function getStocks(){
        //recupera site_id dell'utente
        $site = auth()->user()->site_id;

        $categories = Category::with(['products' => function ($query) use ($site) {
            $query->where('site_id', $site)
                ->orderBy('name');
        }])->orderBy('name')->get();

        //dd($products);    
        return view('pages.products.edit-stock', compact('categories'));
    }

    public function setStocks(Request $request)
    {
        $id=$request->input('id');

        if($product=Product::find($id)){
            $product->num_items=$request->input('num_items');
            $product->default_daily_stock=$request->input('default_daily_stock');
            $product->save();
        }     
    }
}
