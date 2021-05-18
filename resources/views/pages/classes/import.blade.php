@extends('layouts.app', ['title' => 'Importazione studenti'])
@include('plugins.toastr')

@section('content')
<div class="container">

    <div class="card bg-light mt-3">
        <div class="card-header">
            Importazione CLASSI da file CSV
        </div>

        <div class="card-body">
            <form action="{{ route('classes.import-csv') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" name="file" onchange="$('#upload-file-info').html(this.files[0].name)">
                      <label class="custom-file-label" id="upload-file-info" for="customFile">Scegli il file</label>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-success">Importa</button>
            </form>
        </div>
    </div>



</div>
@endsection

