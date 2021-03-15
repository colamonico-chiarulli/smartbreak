@extends('layouts.app', ['title' => 'Ordini del giorno '. formatDate($date)])

@section('content')

<div class="row">
    <div class="col-md-4 ml-auto">
        <div class="form-group">
            <label for="date">Visualizza gli ordini della data:</label>
            <div class="input-group">
                <input type="date" class="form-control" id="date" placeholder="Seleziona una data" value="{{ $date }}">
                <span class="input-group-append">
                    <a
                       href="javascript:;"
                       onclick="location.href = '{{ route('products.by-day') }}/'+document.getElementById('date').value"
                       class="btn btn-primary btn-flat" data-toggle="tooltip" title="Cerca ordini per data">
                        <i class="fas fa-search"></i>
                    </a>
                </span>
            </div>
        </div>
    </div>
</div>


    <div class="card">
        <div class="card-header cursor-pointer">
            <h3 class="card-title text-bold">Prodotti ordinati del giorno</h3>
        </div>

        <div class="card-body">

            <table class="table table-sm table-striped">

                <thead>
                    <tr>
                        <th>Prodotto</th>
                        <th>Prezzo</th>
                        <th class="text-right">Quantità richieste</th>
                        <th class="text-right">Giacenza</th>
                        <th class="text-right">Disponibilità quotidiana</th>
                        <th class="text-right">Totale</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product['product']['name'] }}</td>

                        <td>
                            {{ formatPrice($product['product']['price']) }}
                        </td>

                        <td class="text-right">
                            <span class="badge badge-primary">
                                {{ $product['quantity'] }}
                            </span>
                        </td>

                        <td class="text-right">
                            {{ $product['product']['num_items'] }}
                        </td>

                        <td class="text-right">
                            {{ $product['product']['default_daily_stock'] }}
                        </td>

                        <td class="text-right">{{ formatPrice($product['price']) }}</td>
                    </tr>
                    @endforeach

                </tbody>

                <tfoot>
                    <tr class="table-primary">
                        <td class="text-right" colspan="6">
                            Totale: <b>{{ formatPrice(collect($products)->sum('price')) }}</b>
                        </td>
                    </tr>
                </tfoot>


            </table>

        </div>

    </div>

@endsection
