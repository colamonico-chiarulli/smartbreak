@extends('layouts.app', ['title' => 'Modifica categoria'])

@section('content')

@include('pages.sites._form', [
    'cardTitle' => 'Modifica una sede',
    'headercolor' => 'bg-info',
    'action' => route('sites.update', $site->id),
    'button' => 'Aggiorna',
    'method' => "PUT",
])

@endsection
