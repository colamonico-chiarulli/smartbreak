<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SchoolClass;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = User::where('role', 'STUDENT')
                    ->paginate(8);
        $classes = SchoolClass::all();
        return view('pages.students.index', compact('students', 'classes'));
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
        // validare i dati di input
        $request->validate(User::validationRules());

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
        return view('pages.students.show', compact('student','classes'));
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
        return view('pages.students.edit', compact('student','classes'));
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
        $request->validate(User::validationRules());

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
