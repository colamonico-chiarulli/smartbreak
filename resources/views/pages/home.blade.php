@extends('layouts.app', ['title' => 'Home page'])

@section('content')

@foreach($categories as $category)
<div id="accordion">
    <div class="card card-default">
        <div class="card-header">
            <h4 class="card-title w-100">
                <a class="d-block w-100" data-toggle="collapse" href="#category-{{ $category->id }}">
                    {{ $category->name }}
                </a>
            </h4>
        </div>
        <div id="category-{{ $category->id }}" class="collapse show" data-parent="#accordion">
            <div class="card-body">
                @include('partials.product-card')
                @include('partials.product-card')
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection