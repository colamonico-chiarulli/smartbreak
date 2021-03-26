<div class="container">
    <div class="row">
        <div class="col-12 text-right mb-3">
            <a href="{{ route('users.index') }}" class="btn btn-info">Elenco utenti</a>
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
                               value="{{ $user->first_name ?? old('first_name') }}"
                               {{$readonly ?? ''}}>
                    </div>
                    
                    <div class="form-group">
                        <label for="last_name">Cognome *</label>
                        <input type="text" class="form-control @error('last_name')is-invalid @enderror" id="last_name" name="last_name" placeholder="Inserisci il nome"
                               value="{{ $user->last_name ?? old('last_name') }}"
                               {{$readonly ?? ''}}>
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" class="form-control @error('email')is-invalid @enderror" id="email" name="email"
                               placeholder="Indirizzo email"
                               value="{{ $user->email ?? old('email') }}"
                               {{$readonly ?? ''}}>
                    </div>
                @isset($setPassword)
                    
                    <div class="form-group">
                        <label for="password">Password *</label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password')is-invalid @enderror" id="password" name="password"
                                   placeholder="(Lunghezza minima 8 caratteri, 1 Maiuscola, 1 minuscola, 1 numero, 1 carattere speciale)" 
                                   {{$readonly ?? ''}}>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Conferma Password *</label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password_confirmation')is-invalid @enderror" id="password_confirmation" name="password_confirmation"
                                   placeholder="Riscrivi la password" 
                                   {{$readonly ?? ''}}>
                        </div>
                    </div>
                        
                @endisset

                <div class="form-group">
                    <label for="role">Ruolo *</label>
                    <select class="form-control @error('role')is-invalid @enderror" id="role" name="role" {{$readonly ?? ''}}>
                        <option value="">Seleziona un Ruolo </option>
                        <option value="ADMIN"       
                            @if($user->role == "ADMIN")
                            selected="selected"
                            @endif
                            >Amministratore</option>
                        </option>
                        <option value="MANAGER"
                            @if($user->role == "MANAGER")
                            selected="selected"
                            @endif
                            >BAR Manager</option>
                        </option>
                    </select>

                    <div class="form-group">
                        <label for="site_id">Sede *</label>
                        <select class="form-control @error('site_id')is-invalid @enderror" id="site_id" name="site_id" {{$readonly ?? ''}}>
                            <option value="">Seleziona una sede</option>
                            @foreach ($sites as $site)
                            <option value="{{ $site->id }}"
                                    @if($site->id == $user->site_id)
                                selected="selected"
                                @endif
                                >{{ $site->name }}</option>
                            @endforeach
                        </select>
                    </div>

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
