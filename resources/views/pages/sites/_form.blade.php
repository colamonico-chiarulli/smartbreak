<div class="container">
    <div class="row">
        <div class="col-12 text-right mb-3">
            <a href="{{ route('sites.index') }}" class="btn btn-info">Elenco sedi</a>
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

                    <div class="form-group">
                        <label for="name">Sede *</label>
                        <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" name="name" placeholder="Inserisci una sede"
                               value="{{ $site->name ?? old('name') }}"
                               {{$readonly ?? ''}}>
                    </div>

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
