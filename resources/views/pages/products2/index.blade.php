@extends('layouts.app', ['title' => 'Elenco prodotti'])

@section('stylesheets')
  @parent
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">    
@endsection

@section('content')
    <div class="row">
        <div class="container">
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('products.create') }}">Aggiungi un prodotto</a>
            </div>
        </div>
    </div>

    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>Prezzo</th>
                    <th>Disponibilità</th>
                    <th>Categoria</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <img src="{{ asset('img/products/' . $product->photo_path) }}" alt="" width="35px">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>€ {{ $product->price }}</td>
                        <td class="text-center">
                            @if ($product->num_items <= 10)
                                <span class="badge badge-danger">
                                    {{ $product->num_items }}
                                </span>
                            @else
                                <span class="badge badge-success">
                                    {{ $product->num_items }}
                                </span>
                            @endif

                        </td>
                        <td></td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('products.show', $product->id) }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="btn btn-warning btn-sm" href="{{ route('products.edit', $product->id) }}">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a class="btn btn-danger btn-sm" href="{{ route('products.delete', $product->id) }}">
                                <i class=" fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $products->links() !!}
    </div>
@endsection

@section('js_scripts')
    @parent
    @include('partials.notification')
@endsection