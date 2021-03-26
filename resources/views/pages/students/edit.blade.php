@extends('layouts.app', ['title' => 'Modifica studente'])

@section('content')

@include('pages.students._form', [
    'cardTitle' => 'Modifica un studente',
    'headercolor' => 'bg-info',
    'action' => route('students.update', $student->id),
    'button' => 'Aggiorna',
    'method' => "PUT",
    'setPassword' => True,
])

@endsection
