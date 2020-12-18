@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Crear área de conocimiento</h4>
        <form class="form" action="{{ route('areas_conocimiento.store') }}" method="POST">
            @csrf

            <div class="form-group row">
                <label for="codigo" class="col-md-3">Código <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="codigo" type="number" pattern="[0-9]" name="codigo" class="form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }}" value="{{ old('codigo') }}" required>
                </div>

                @if ($errors->has('codigo'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('codigo') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group row">
                <label for="nombre" class="col-md-3">Nombre del área de conocimiento <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="nombre" type="text" name="nombre" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" value="{{ old('nombre') }}" required>
                </div>

                @if ($errors->has('nombre'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('nombre') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-9 offset-md-3">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
