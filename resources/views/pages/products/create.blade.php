@extends('layouts.app', ['title' => 'Crea prodotto'])

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
            <h3 class="card-title">Inserisci nuovo prodotto</h3>
        </div>
        <form action="{{ route('products.store') }}" method="post">
            <div class="card-body">

                @csrf 
                <!-- name => input text -->
                <div class="form-group">
                    <label for="name">Nome *</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Inserisci un nome">
                </div>

                <div class="form-group">
                    <label for="description">Descrizione *</label>
                    <textarea class="form-control" id="description" name="description"
                              placeholder="Inserisci una descrizione o gli ingredienti" required></textarea>
                </div>

                <div class="form-group">
                    <label for="allergens">Allergeni</label>
                    <input type="text" class="form-control" id="allergens" name="allergens"
                           placeholder="Inserisci gli allergeni">
                </div>

                <div class="form-group">
                    <label for="price">Prezzo *</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="price" name="price"
                               placeholder="Inserisci il prezzo" required>
                        <div class="input-group-append">
                            <span class="input-group-text">€</span>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="num_items" required>Quantità disponibile *</label>
                            <input type="number" class="form-control" id="num_items" name="num_items"
                                   placeholder="Inserisci la quantità disponibile">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="num_daily_stock">Disponibilità quotidiana</label>
                            <input type="number" class="form-control" id="num_daily_stock" name="num_daily_stock"
                                   placeholder="Inserisci la disponibilità quotidiana">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="photo_path">Foto</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="photo_path">
                            <label class="custom-file-label" for="photo_path">Sfoglia</label>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="category_id">Categoria *</label>
                    <select class="form-control" id="category_id" required>
                        <option value="">Seleziona una categoria</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Inserisci</button>
            </div>
        </form>
    </div>

</div>

@endsection
