<?php
/**
 * File:	/app/Http/Controllers/StudentController.php
 * @package smartbreak
 * @author  Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	March 26th, 2021 4:06pm
 * -----
 * Last Modified: 	March 27th, 2021 7:17pm
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
use App\Models\User;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\Hash;
use Faker;

class StudentController extends Controller
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
        if (isset($filter)) {
            $students = User::where('role', 'STUDENT')
                ->where('first_name', 'like', '%' . $filter . '%')
                ->orWhere('last_name', 'like', '%' . $filter . '%')
                ->orderBy('class_id', 'asc')
                ->orderBy('last_name', 'asc')
                ->orderBy('first_name', 'asc')
                ->paginate(8);
        } else {
            $students = User::where('role', 'STUDENT')
                ->orderBy('class_id', 'asc')
                ->orderBy('last_name', 'asc')
                ->orderBy('first_name', 'asc')
                ->paginate(8);
        }
        
        $classes = SchoolClass::all();
        return view('pages.students.index', compact('students', 'classes', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = SchoolClass::all();
        $student = new User(); //Serve vuoto per la classe nel form
        return view('pages.students.create', compact('classes', 'student'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // valida i dati di input
        $request->validate(User::StudentValidationRules());

        //Aggiunge una Password Casuale
        $faker = Faker\Factory::create('it_IT');
        $request->request->add(['password' => Hash::make($faker->password())]);

        //Imposta il ruolo di Studente
        $request->request->add(['role' => "STUDENT"]);

        //Imposta la sede prendendola dalla classe
        $site = SchoolClass::find($request->class_id)->site_id;
        $request->request->add(['site_id' => $site]);

        User::create($request->all());

        return redirect()->route('students.index')
            ->with('success', 'Studente aggiunto');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $student
     * @return \Illuminate\Http\Response
     */
    public function show(User $student)
    {
        $classes = SchoolClass::all();
        return view('pages.students.show', compact('student', 'classes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(User $student)
    {
        $classes = SchoolClass::all();
        return view('pages.students.edit', compact('student', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $student)
    {
        $request->validate(User::StudentValidationRules());

        $student->update($request->all());
        return redirect()->route('students.index')
            ->with('success', 'Utente aggiornato!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $student)
    {
        $student->delete();
        return $student;
    }
}
