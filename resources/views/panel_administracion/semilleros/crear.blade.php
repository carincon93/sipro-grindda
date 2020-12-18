@extends('layouts.app')

@section('content')
    <div class="container">
        @can ('crear-semillero')
            <form action="{{ route('semilleros.store') }}" method="POST">
                @csrf

                <div class="form-group row">
                    <label for="nombre" class="col-md-3">Nombre del semillero <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input id="nombre" type="text" name="nombre" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" value="{{ old('nombre') }}" maxlength="191" required>
                    </div>

                    @if ($errors->has('nombre'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                    @endif

                </div>

                <div class="form-group row">
                    <label for="descripcion" class="col-md-3">Descripción del semillero <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <textarea id="descripcion" name="descripcion" rows="4" cols="80" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" required>{{ old('descripcion') }}</textarea>
                    </div>

                    @if ($errors->has('descripcion'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('descripcion') }}</strong>
                        </span>
                    @endif

                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>

            </form>
        @endcan

    </div>
@endsection
