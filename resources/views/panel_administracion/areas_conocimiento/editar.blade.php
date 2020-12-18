@extends('layouts.app')
@section('content')

    <div class="container">
        <form class="form" action="{{ route('areas_conocimiento.update', $area->id) }}" method="POST">
            @method('PUT')
            @csrf

            <div class="form-group row">
                <label class="col-md-3" for="codigo">Código <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="codigo" type="number" pattern="[0-9]" class="form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }}" name="codigo" value="{{ $area->codigo }}" required>
                </div>

                @if ($errors->has('codigo'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('codigo') }}</strong>
                    </span>
                @endif

            </div>

            <div class="form-group row">
                <label class="col-md-3" for="nombre">Nombre <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ $area->nombre }}" required>
                </div>

                @if ($errors->has('nombre'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('nombre') }}</strong>
                    </span>
                @endif

            </div>
            <div class="form-group row mb-0">
                <div class="col-md-9 offset-md-3">
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </form>
    </div>
@endsection
