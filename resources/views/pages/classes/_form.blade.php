<div class="container">
    <div class="row">
        <div class="col-12 text-right mb-3">
            <a href="{{ route('classes.index') }}" class="btn btn-info">Elenco classi</a>
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
                        <label for="year">Anno *</label>
                        <input type="number" min=1 max=5 class="form-control @error('year')is-invalid @enderror" id="year" name="year"
                            placeholder="1..5" 
                               value="{{ $class->year ?? old('year') }}"
                               {{$readonly ?? ''}}>
                    </div>

                    <div class=" form-group">
                        <label for="section">Sezione *</label>
                        <input type="text" class="form-control @error('section')is-invalid @enderror" id="section" name="section"
                            placeholder="Inserire la sezione (Es. A)" 
                            value="{{ $class->section ?? old('section') }}"
                            {{$readonly ?? ''}}>
                    </div>

                    <div class="form-group">
                        <label for="course">Indirizzo *</label>
                        <input type="text" class="form-control @error('course')is-invalid @enderror" id="course" name="course"
                               placeholder="Indirizzo di studio - 3 caratteri Es. INF" 
                               value="{{ $class->course ?? old('course') }}"
                               {{$readonly ?? ''}}>
                    </div>


                    <div class="form-group">
                        <label for="site_id">Sede *</label>
                        <select class="form-control @error('site_id')is-invalid @enderror" id="site_id" name="site_id" {{$readonly ?? ''}}>
                            <option value="">Seleziona una sede</option>
                            @foreach ($sites as $site)
                            <option value="{{ $site->id }}"
                                    @if($site->id == $formSite)
                                selected="selected"
                                @endif
                                >{{ $site->name }}</option>
                            @endforeach
                        </select>
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
