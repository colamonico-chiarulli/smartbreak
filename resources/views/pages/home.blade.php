@extends('layouts.app', ['title' => 'Home page'])

@section('content')
<div id="accordion">
    <div class="card card-default">
        <div class="card-header">
            <h4 class="card-title w-100">
                <a class="d-block w-100" data-toggle="collapse" href="#category-panini">
                    Panini
                </a>
            </h4>
        </div>
        <div id="category-panini" class="collapse show" data-parent="#accordion">
            <div class="card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                3
                wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                laborum
                eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                nulla
                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
                beer
                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                labore sustainable VHS.
            </div>
        </div>
    </div>
</div>

@endsection
