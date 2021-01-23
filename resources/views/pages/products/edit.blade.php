@extends('layouts.app', ['title' => 'Modifica prodotto'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-right mb-3">
                <a href="{{ route('products.index') }}" class="btn btn-info">Elenco prodotti</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 card shadow">
                <div class="card-header">
                    <h3 class="card-title">Modifica un prodotto</h3>
                </div>
                <form action="{{ route('products.update', $product->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Attenzione!</strong> Verifica i dati inseriti.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="name">Nome *</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Inserisci un nome"
                                value="{{ $product->name }}">
                        </div>

                        <div class=" form-group">
                            <label for="description">Descrizione *</label>
                            <textarea class="form-control" id="description" name="description"
                                placeholder="Inserisci una descrizione o gli ingredienti">{{ $product->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="allergens">Allergeni</label>
                            <input type="text" class="form-control" id="allergens" name="allergens"
                                placeholder="Inserisci gli allergeni" value="{{ $product->allergens }}">
                        </div>

                        <div class="form-group">
                            <label for="price">Prezzo *</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="price" name="price"
                                    placeholder="Inserisci il prezzo" value="{{ $product->price }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">€</span>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="num_items">Quantità disponibile *</label>
                                    <input type="number" class="form-control" id="num_items" name="num_items"
                                        placeholder="Inserisci la quantità disponibile" value="{{ $product->num_items }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="default_daily_stock">Disponibilità quotidiana</label>
                                    <input type="number" class="form-control" id="default_daily_stock"
                                        name="default_daily_stock" placeholder="Inserisci la disponibilità quotidiana"
                                        value="{{ $product->default_daily_stock }}">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="photo_path">Foto</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="photo_path" name="photo_path"
                                        value="{{ $product->photo_path }}">
                                    <label class="custom-file-label" for="photo_path">Sfoglia</label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="category_id">Categoria *</label>
                            <select class="form-control" id="category_id" name="category_id">
                                <option value="">Seleziona una categoria</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($category->id == $product->category_id)
                                        selected="selected"
                                @endif>
                                {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Aggiorna</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
