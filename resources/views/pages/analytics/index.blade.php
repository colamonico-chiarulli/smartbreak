<?php
/**
 * File:	/resources/views/pages/analytics/index.blade.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	March 30th, 2021 10:54am
 * -----
 * Last Modified: 	May 3rd 2021 4:47:22 pm
 * Modified By: 	Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * -----
 * @license	https://www.gnu.org/licenses/agpl-3.0.html AGPL 3.0
 * ------------------------------------------------------------------------------
 * SmartBreak is a School Bar food booking web application
 * developed during the PON course "The AppFactory" 2020-2021 with teachers
 * & students of "Informatica e Telecomunicazioni"
 * at IISS "C. Colamonico - N. Chiarulli" Acquaviva delle Fonti (BA)-Italy
 * Expert dr. Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * ----------------------------------------------------------------------------
 * SmartBreak is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by
 * the Free Software Foundation
 *
 * SmartBreak is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * You should have received a copy of the GNU Affero General Public License along
 * with this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * The interactive user interfaces in original and modified versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the SmartBreak
 * logo and IISS "Colamonico-Chiarulli" copyright notice. If the display of the logo
 * is not reasonably feasible for technical reasons, the Appropriate Legal Notices
 * must display the words
 * "(C) IISS Colamonico-Chiarulli-https://colamonicochiarulli.edu.it - 2021".
 *
 * ------------------------------------------------------------------------------
 */

?>
@extends('layouts.app', ['title' => 'Statistiche ' . $title ])

@include('plugins.chartjs')
@include('plugins.toastr')

@section('content')
<div id="loader" class="spinner"></div>
<div>
    <div class="row d-flex justify-content-center mb-3">
        <div class="btn-group btn-group-toggle text-center" data-toggle="buttons">
            <label class="btn bg-olive">
                <input type="radio" name="period" value="week" id="option_b1" autocomplete="off"
                    @cannot('is-student')checked="" @endcannot> Settimana
            </label>
            <label class="btn bg-olive active">
                <input type="radio" name="period" value="month" id="option_b2" autocomplete="off"
                    @can('is-student')checked="" @endcan> Mese
            </label>
            <label class="btn bg-olive">
                <input type="radio" name="period" value="year" id="option_b3" autocomplete="off"> Anno
            </label>
        </div>
    </div>

    <div class="row d-flex justify-content-center mb-3">
        <div class="btn-group btn-group-toggle text-center" data-toggle="buttons">
            <label class="btn btn-info">
                <input type="radio" name="move" id="move_left" value="left" autocomplete="off"><i
                    class="fas fa-angle-left"></i>
            </label>
            <span id="period" class="form-control rounded-0 text-center align-middle font-weight-bold">
                {{$range['label']}}
            </span>
            <label class="btn bg-info">
                <input type="radio" name="move" id="move_right" value="right" autocomplete="off"><i
                    class="fas fa-angle-right"></i>
            </label>
        </div>
    </div>
</div>
<div class="row justify-content-around">
    <div class="small-box bg-success col col-md-3">
        <div class="inner">
            <h4 id="stat1">{{ $stats['box1'] ?? "" }}</h4>
            @can('is-admin')<p>Utenti</p>@endcan
            @can('is-manager')<p>Ricavi</p>@endcan
            @can('is-student')<p>Hai speso</p>@endcan
        </div>
        <div class="icon">
            @can('is-admin')<i class="fas fa-users fa-lg"></i>@endcan
            @cannot('is-admin')<i class="fas fa-euro-sign"></i></p>@endcannot
        </div>
    </div>
    <div class="small-box bg-info col col-md-3">
        <div class="inner">
            <h4 id="stat2">{{ $stats['box2']  ?? "" }}</h4>
            <p>Ordini</p>
        </div>
        <div class="icon">
            <i class="fas fa-shopping-bag"></i>
        </div>
    </div>
    <div class="small-box bg-warning col col-md-3">
        <div class="inner">
            <h4 id="stat3">{{ $stats['box3'] ?? "" }}</h4>
            <p>Prodotti</p>
        </div>
        <div class="icon">
            <i class="fas fa-hamburger"></i>
        </div>
    </div>
</div>

<div class="row d-flex justify-content-around">
    <div class="col-md-5 callout callout-info"><canvas id="barChart" width="400" height="400"></canvas></div>
    <div class="col-md-5 callout callout-warning"><canvas id="pieChart" width="400" height="400"></canvas></div>
</div>
@endsection

@push('js')
<script>
    //global variables
var formMove = null;
var formRange = [];

/**
 * EVENTS
 */ 
    
//On page loaded
 $(function () {
    getCharts();
});

//Button period pressed
//$("input[name='period']").change(updateCharts);
$("input[name='period']").change(changePeriod);

//Button move pressed 
$("input[name='move']").click(move);

/**
 * changePeriod
 */
function changePeriod(){
    var today = new Date();
    formRange['from']=today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    getCharts();
}


/**
 * move
 * actions on left-right arrow
 */ 
function move(){
    formMove = $('input[name="move"]:checked').val();
    getCharts();
    formMove = null;
}

function getCharts(){
var formPeriod = $('input[name="period"]:checked').val(); 

$.ajax({
            url: '{{ route("analytics.getcharts") }}',
            method: "POST",
            data: {
                period: formPeriod,
                move: formMove,
                range: formRange,
            },
            beforeSend: function(){
                $('#loader').addClass('spinner');
            },
            success: function name(result) {
                if (result.barChart.datasets[0].data.length !== 0){
                    barChart.data.labels=result.barChart.labels;
                    barChart.data.datasets=result.barChart.datasets;
                    $("#period").html(result.range['label']);
                    barChart.options.title.text=result.barChart.title;
                    barChart.update();
                    formRange = result.range;
                } else {
                    toastr.options.timeOut = 2000;
                    toastr.info("Non ci sono dati per il periodo scelto");
                }
                if (result.pieChart.datasets[0].data.length !== 0){
                    pieChart.data=result.pieChart;
                    pieChart.options.title.text=result.pieChart.title;
                    pieChart.update();
                }
                if (result.stats){
                    $("#stat1").html(result.stats.box1);
                    $("#stat2").html(result.stats.box2);
                    $("#stat3").html(result.stats.box3);
                }  
            },
            complete:function(data){
                $('#loader').removeClass('spinner');
            }
        });
}    

//BarChart
var barCtx = document.getElementById('barChart').getContext('2d');
var barChart = new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [],
    },
    options: {
        responsive:true,
        maintainAspectRatio: true,
        title: {
                display: true,
                text: ''
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },    
@cannot('is-admin') {{-- Format Price if MANAGER or STUDENT --}}   
        tooltips: {
            callbacks: {
                label: function (tooltipItems, data) {
                    return formatPrice(tooltipItems.yLabel);
                }
            }
        }
@endcannot     
    }
});

//PieChart
var pieCtx = document.getElementById('pieChart').getContext('2d');
var pieChart = new Chart(pieCtx, {
    type: 'doughnut',
    data: {},
    options: {
        responsive:true,
        maintainAspectRatio: true,
        title: {
                display: true,
                text: ''
        },
@cannot('is-admin') {{-- Format Price if MANAGER or STUDENT--}}   
        tooltips: {
            callbacks: {
                label: function (tooltipItem, data) {
                    //get the concerned dataset
                    var dataset = data.datasets[tooltipItem.datasetIndex];
                    //get the current items value
                    var currentValue = dataset.data[tooltipItem.index];
                    return data.labels[tooltipItem.index] + ": " + formatPrice(currentValue);
                }
            }
        }
@endcannot
    }
});

</script>
@endpush