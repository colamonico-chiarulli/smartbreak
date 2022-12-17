@extends('layouts.app', ['title' => 'Apri/Chiudi Bar'])

@section('content')

<div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-focused bootstrap-switch-animate bootstrap-switch-off" style="width: 86px;"><div class="bootstrap-switch-container" style="width: 126px; margin-left: -42px;"><span class="bootstrap-switch-handle-on bootstrap-switch-success" style="width: 42px;">ON</span><span class="bootstrap-switch-label" style="width: 42px;">&nbsp;</span><span class="bootstrap-switch-handle-off bootstrap-switch-danger" style="width: 42px;">OFF</span><input type="checkbox" name="my-checkbox" checked="" data-bootstrap-switch="" data-off-color="danger" data-on-color="success"></div></div>


    
@endsection

@push('js')



@endpush