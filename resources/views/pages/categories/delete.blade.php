@extends('layouts.app', ['title' => 'Cancella categoria'])

@section('content')

    @include('pages.categories._form', [
        'cardTitle' => 'Cancella un categoria',
        'headercolor' => 'bg-danger',
        'action' => route('categories.destroy', $category->id),
        'button' => 'Cancella',
        'method' => "DELETE",
        ])

@endsection