@extends('layouts.app', ['title' => 'Modifica classe'])

@section('content')

@include('pages.classes._form', [
    'cardTitle' => 'Modifica una classe',
    'headercolor' => 'bg-info',
    'action' => route('classes.update', $class->id),
    'button' => 'Aggiorna',
    'method' => "PUT",
])

@endsection
