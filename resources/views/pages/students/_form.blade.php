<div class="container">
    <div class="row">
        <div class="col-12 text-right mb-3">
            <a href="{{ route('students.index') }}" class="btn btn-info">Elenco Studenti</a>
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
                        <label for="first_name">Nome *</label>
                        <input type="text" class="form-control @error('first_name')is-invalid @enderror" id="first_name" name="first_name" placeholder="Inserisci il nome"
                               value="{{ $student->first_name ?? old('first_name') }}"
                               {{$readonly ?? ''}}>
                    </div>
                    
                    <div class="form-group">
                        <label for="last_name">Cognome *</label>
                        <input type="text" class="form-control @error('last_name')is-invalid @enderror" id="last_name" name="last_name" placeholder="Inserisci il nome"
                               value="{{ $student->last_name ?? old('last_name') }}"
                               {{$readonly ?? ''}}>
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" class="form-control @error('email')is-invalid @enderror" id="email" name="email"
                               placeholder="Indirizzo email"
                               value="{{ $student->email ?? old('email') }}"
                               {{$readonly ?? ''}}>
                    </div>


                <div class="form-group">
                    <label for="class_id">Classe *</label>
                    <select class="form-control @error('class_id')is-invalid @enderror" id="class_id" name="class_id" {{$readonly ?? ''}}>
                        <option value="">Seleziona una classe </option>
                        
                        @foreach ($classes as $class)
                            <option value="{{$class->id}}" {{ isset($student) && $class->id == $student->class_id ? 'selected' : '' }} >
                                {{ $class->name }}
                            </option>
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
