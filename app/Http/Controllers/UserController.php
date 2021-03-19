<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', 'MANAGER')
                       ->orWhere('role', 'ADMIN')
                       ->get();
        return view('pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Recupera l'eventuale ruolo già inserito nel Form (in presenza di errori)
        $formRole = old('role') ?: null;
        return view('pages.users.create', compact('formRole'));
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

        return redirect()->route('users.index')
            ->with('success', 'Utente aggiunto');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //Recupera l'eventuale ruolo già inserito nel Form (in presenza di errori)
        $formRole = $user->role;
        return view('pages.users.show', compact('user','formRole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //Recupera l'eventuale ruolo già inserito nel Form (in presenza di errori)
        $formRole = $user->role;
        return view('pages.users.edit', compact('user', 'formRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate(User::validationRules());
        
        $user->update($request->all());
        $formUser = $user->role;
        return redirect()->route('users.index')
            ->with('success', 'Utente aggiornato!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        
        return $user;
    }
}
