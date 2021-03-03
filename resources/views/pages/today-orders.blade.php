@extends('layouts.app', ['title' => 'Ordini del giorno '.now()->toDateString()])

@section('content')

    @foreach($classes as $class)

    <div id="accordion">
        <div class="card">
            <div class="card-header" data-toggle="collapse" href="#class-{{ $class['class']->id }}">
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
