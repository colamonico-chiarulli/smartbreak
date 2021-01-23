@extends('layouts.app', ['title' => 'Mostra prodotto'])

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 text-right">
                <a href="{{ route('products.index') }}" class="btn btn-info">Elenco prodotti</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-sm-12 m-auto">
                <div class="card shadow">
                    <div class="card-header">
                        <h3 class="card-title">Visualizzazione prodotto</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nome: </strong>
                            {{ $product->name }}
                        </div>

                        <div class="form-group">
                            <strong>Descrizione: </strong>
                            {{ $product->description }}
                        </div>

                        <div class="form-group">
                            <strong>Allergeni: </strong>
                            {{ $product->allergens }}
                        </div>

                        <div class="form-group">
                            <strong>Prezzo: </strong>
                            {{ $product->price }}
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong for="num_items">Quantità disponibile: </strong>
                                    {{ $product->num_items }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong for="num_daily_stock">Disponibilità quotidiana: </strong>
                                    {{ $product->default_daily_stock }}
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <strong for="photo_path">Foto: </strong>
                            {{ $product->photo_path }}
                        </div>


                        <div class="form-group">
                            <strong for="category_id">Categoria: </strong>
                            {{ $product->category_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
