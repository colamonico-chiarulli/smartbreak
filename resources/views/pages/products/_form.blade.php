<div class="container">
    <div class="row">
        <div class="col-12 text-right mb-3">
            <a href="{{ route('products.index') }}" class="btn btn-info">Elenco prodotti</a>
        </div>
    </div>

    <div class="row">
        <div class="card w-100 shadow">
            <div class="card-header {{$headercolor ?? ''}}">
                <h3 class="card-title">{{$cardTitle}}</h3>
            </div>

            <form action="{{ $action }}" method="post">
                @csrf
                @isset ($method)
                @method($method)
                @endisset
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Attenzione!</strong> Verifica i dati inseriti.<br><br>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nome *</label>
                                <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" name="name" placeholder="Inserisci un nome"
                                    value="{{ $product->name ?? old('name') }}"
                                    {{$readonly ?? ''}}>
                            </div>

                            <div class=" form-group">
                                <label for="description">Descrizione *</label>
                                <textarea class="form-control @error('description')is-invalid @enderror" id="description" name="description"
                                        placeholder="Inserisci una descrizione o gli ingredienti"
                                        {{$readonly ?? ''}}>{{ $product->description ?? old('description') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="price">Prezzo *</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" class="form-control @error('price')is-invalid @enderror" id="price" name="price"
                                        placeholder="Inserisci il prezzo" value="{{ $product->price ?? old('price') }}"
                                        {{$readonly ?? ''}}>
                                    <div class="input-group-append">
                                        <span class="input-group-text">€</span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="allergens">Allergeni</label>
                                <input type="text" class="form-control @error('allergens')is-invalid @enderror" id="allergens" name="allergens"
                                    placeholder="Inserisci gli allergeni"
                                    value="{{ $product->allergens ?? old('allergens') }}"
                                    {{$readonly ?? ''}}>
                            </div>

                        </div>
                        <div class="col-md-6">

                            @if(isset($product) && $product->photo_url)
                            <div class="text-center">
                                <img src="{{ $product->photo_url }}" alt="" style="max-height:250px;">
                            </div>
                            @endif

                            <div class="form-group">
                                <label for="photo_path">Foto prodotto*</label>
                                <input type="file" id="photo" name="photo">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="num_items">Quantità disponibile *</label>
                                <input type="number" class="form-control @error('num_items')is-invalid @enderror" id="num_items" name="num_items"
                                       placeholder="Inserisci la quantità disponibile"
                                       value="{{ $product->num_items ?? old('num_items') }}"
                                       {{$readonly ?? ''}}>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="default_daily_stock">Disponibilità quotidiana</label>
                                <input type="number" class="form-control @error('default_daily_stock')is-invalid @enderror" id="default_daily_stock"
                                       name="default_daily_stock" placeholder="Inserisci la disponibilità quotidiana"
                                       value="{{ $product->default_daily_stock ?? old('default_daily_stock') }}"
                                       {{$readonly ?? ''}}>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="category_id">Categoria *</label>
                        <select class="form-control @error('category_id')is-invalid @enderror" id="category_id" name="category_id" {{$readonly ?? ''}}>
                            <option value="">Seleziona una categoria</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ isset($product) && $category->id == $product->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @can('is-admin')
                    <div class="form-group">
                        <label for="site_id">Sede *</label>
                        <select class="form-control @error('site_id')is-invalid @enderror" id="site_id" name="site_id" {{$readonly ?? ''}}>
                            <option value="">Seleziona una sede</option>
                            @foreach ($sites as $site)
                            <option value="{{ $site->id }}" {{ isset($product) && ($site->id == $product->site_id) ? 'selected' : '' }}>
                                {{ $site->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                     @endcan


                </div>
                <div class="card-footer">
                    @empty($readonly)
                    <button type="submit" class="btn btn-primary">{{$button}}</button>
                    @endempty
                </div>
            </form>
        </div>

    </div>
</div>

@include('plugins.filepond')
@push('js')
    <script>
        const pond = FilePond.create(document.getElementById('photo'));
    </script>
@endpush
