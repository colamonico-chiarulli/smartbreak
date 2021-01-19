@extends('layouts.app', ['title' => 'Mostra prodotto'])

@section('content')

<!--

        - name => input text
        - description => texteara
        - allergens => input text
        - price => input number
        - num_items => input number
        - default_daily_stock => input number
        - photo_path => input file
        - category_id => select

    -->

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Visualizzazione prodotto</h3>
        </div>
            <div class="card-body">

                <!-- name => input text -->
                <div class="form-group">
                    <strong>Nome *</strong>
                    {{ $product->name }}
                </div>

                <div class="form-group">
                    <strong>Descrizione *</strong>
                    {{ $product->description }}
                </div>

                <div class="form-group">
                    <strong>Allergeni</strong>
                    {{ $product->allergens }}
                </div>

                <div class="form-group">
                    <strong>Prezzo *</strong>
                    {{ $product->price }}
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong for="num_items" required>Quantità disponibile *</strong>
                            {{ $product->num_items }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong for="num_daily_stock">Disponibilità quotidiana</strong>
                            {{ $product->default_daily_stock }}
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <strong for="photo_path">Foto</strong>
                    {{ $product->photo_path }}
                </div>


                <div class="form-group">
                    <strong for="category_id">Categoria *</strong>
                    {{ $product->category_id }}
                </div>

            </div>
    </div>

</div>

@endsection
