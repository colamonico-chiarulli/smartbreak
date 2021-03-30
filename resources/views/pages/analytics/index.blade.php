@extends('layouts.app', ['title' => 'Home page'])

@include('plugins.chartjs')

@section('content')
    <canvas id="myChart" width="400" height="400"></canvas>
@endsection

@push('js')
    <script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {

        // labels => giorni
        // data => fatturato giornaliero
        labels: @json($labels),
        datasets: @json($datasets)
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
    </script>
@endpush
