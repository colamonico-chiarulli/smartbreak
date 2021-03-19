<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Gate::check('is-manager')) {
            $route = 'orders.by-day';
        } elseif (Gate::check('is-student')) {
            $route = 'cart.choose-products';
        } elseif (Gate::check('is-admin')) {
            return view('pages.admin');
        } else {
            abort(403);
        }

        return redirect()->route($route);
    }
}
