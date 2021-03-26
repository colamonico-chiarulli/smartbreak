@extends('layouts.app', ['title' => 'Crea Studente'])

@section('content')

    @include('pages.students._form', [
        'cardTitle' => 'Inserisci nuovo studente',
        'headercolor' => 'bg-success',
        'action' => route('students.store'),
        'button' => 'Salva',
    ])

@endsection
