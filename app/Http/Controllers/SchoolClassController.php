<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolClass;
use App\Models\Site;


class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = SchoolClass::latest()->paginate(8);

        return view('pages.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sites = Site::all();
        //Recupera l'eventuale categoria già inserita nel Form (in presenza di errori)
        $formSite = old('site_id') ?: null;
        return view('pages.classes.create', compact('sites', 'formSite'));
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
        $request->validate(SchoolClass::validationRules());

        SchoolClass::create($request->all());

        return redirect()->route('classes.index')
            ->with('success', 'Classe aggiunta.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\class  $class
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolClass $class)
    {
        $sites = Site::all();
        $formSite = $class->site_id;
        return view('pages.classes.show', compact('class', 'sites', 'formSite'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\class  $class
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolClass $class)
    {
        $sites = Site::all();
        $formSite = $class->site_id;
        return view('pages.classes.edit', compact('class', 'sites', 'formSite'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\class  $class
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchoolClass $class)
    {
        $request->validate(SchoolClass::validationRules());

        $class->update($request->all());
        return redirect()->route('classes.index')
            ->with('success', 'Classe aggiornata!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\class  $class
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolClass $class)
    {
        $class->delete();

        return $class;
    }
}
