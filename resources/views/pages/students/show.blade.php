@extends('layouts.app', ['title' => 'Visualizza studente'])

@section('content')

    @include('pages.students._form', [
            'cardTitle' => 'Dettaglio studente',
            'action' => route('students.index'),
            'button' => 'Indietro',
            'readonly' => 'readonly',
            ])

@endsection