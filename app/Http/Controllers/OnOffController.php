<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;

class OnOffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.on-off.index');
    }

}
