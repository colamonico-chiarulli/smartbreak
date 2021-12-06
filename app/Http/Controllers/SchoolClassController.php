<?php
/**
 * File:	/app/Http/Controllers/SchoolClassController.php
 * @package smartbreak
 * @author  Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	March 18th, 2021 7:30pm
 * -----
 * Last Modified: 	May 18th 2021 5:52:19 pm
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

use Illuminate\Http\Request;
use App\Models\SchoolClass;
use App\Models\Site;
use App\Imports\SchoolClassImport;
use Maatwebsite\Excel\Facades\Excel;


class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $classes = SchoolClass::sortable()
                    ->orderBy('site_id', 'asc')
                    ->orderBy('year', 'asc')
                    ->orderBy('course', 'asc')
                    ->orderBy('section', 'asc')
                    ->paginate(8);

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

    /**
     * importSchoolClassView.
     * 
     * Visualizza la pagina per la selezione del file students.CSV
     * @access	public
     * @return	mixed
     */
    public function importSchoolClassView()
    {
       return view('pages.classes.import');
    }
    
    /**
     * importSchoolClassCSV.
     *  
     * Importa gli utenti dal file CSV caricato
     * 
     * @access	public
     * @return	mixed
     */
    public function importSchoolClassCSV() 
    {       
        Excel::import(new SchoolClassImport,request()->file('file'));
        return back()->with('success', 'Importazione classi completata');
    }
}
