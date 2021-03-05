@extends('layouts.app', ['title' => 'Modifica categoria'])

@section('content')

@include('pages.categories._form', [
    'cardTitle' => 'Modifica un categoria',
    'headercolor' => 'bg-info',
    'action' => route('categories.update', $category->id),
    'button' => 'Aggiorna',
    'method' => "PUT",
])

@endsection
