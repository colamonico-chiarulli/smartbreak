@extends('layouts.app', ['title' => 'Elenco prodotti'])

@section('content')

    <div class="row">
        <div class="container">
            @if ($message = Session::get('success'))
                <div class="col-xl-8 alert alert-success float-left">
                    <p>{{ $message }}</p>
                </div>
            @endif
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
                            <form action="{{ route('products.destroy', $product->id) }}" method="post"
                                style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"" type=" submit"><i class=" fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $products->links() !!}
    </div>
@endsection