@extends('layouts.app', ['title' => 'Scegli una sede'])

@section('content')

    <div class="row">
        <div class="card w-100 shadow">
            <div class="card-header">
                <h3 class="card-title">Sedi</h3>
            </div>

            <form action="{{ $action }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="site_id">Sede *</label>
                        <select class="form-control @error('site_id')is-invalid @enderror" id="site_id" name="site_id" >
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


@endsection
