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
                       onclick="location.href = '{{ route('orders.by-day') }}/'+document.getElementById('date').value"
                       class="btn btn-primary btn-flat" data-toggle="tooltip" title="Cerca ordini per data">
                        <i class="fas fa-search"></i>
                    </a>
                </span>
            </div>
        </div>
    </div>
</div>


@foreach($classes as $class)

<div id="accordion">
    <div class="card">
        <div class="card-header cursor-pointer" data-toggle="collapse" href="#class-{{ $class['class']->id }}">
            <h3 class="card-title text-bold" data-card-widget="collapse">{{ $class['class']->name }}</h3>

            {{-- <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div> --}}

        </div>

        <div class="show" id="class-{{ $class['class']->id }}">
            <div class="card-body">

                <table class="table table-sm table-striped">

                    <thead>
                        <tr>
                            <th>Prodotto</th>
                            <th class="text-right">Quantità</th>
                            <th class="text-right">Totale</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($class['products'] as $product)
                        <tr>
                            <td>{{ $product['product']['name'] }}</td>

                            <td class="text-right">
                                <span class="badge badge-primary">
                                    {{ $product['quantity'] }}
                                </span>
                            </td>

                            <td class="text-right">{{ formatPrice($product['price']) }}</td>
                        </tr>
                        @endforeach

                    </tbody>

                    <tfoot>
                        <tr class="table-primary">
                            <td class="text-right" colspan="3">
                                Totale: <b>{{ formatPrice(collect($class['products'])->sum('price')) }}</b>
                            </td>
                        </tr>
                    </tfoot>


                </table>

            </div>
            <div class="card-footer">
                <button class="btn btn-success" data-card-widget="collapse" data-toggle="collapse" href="#class-{{ $class['class']->id }}">Ordine preparato</button>
            </div>

        </div>

    </div>
</div>

@endforeach

@endsection
