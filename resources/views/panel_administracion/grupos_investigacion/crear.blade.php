@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('grupos_investigacion.store') }}" method="POST">
            @csrf
            <div class="form-group row">
                <label class="col-md-3" for="nombre">Nombre del grupo de investigación <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="nombre" type="text" name="nombre" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" maxlength="191" value="{{ old('nombre') }}" required>

                    @if ($errors->has('nombre'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                    @endif

                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3" for="descripcion">Descripción del grupo de investigación <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <textarea id="descripcion" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}"  name="descripcion" rows="4" cols="80" required>{{ old('descripcion') }}</textarea>

                    @if ($errors->has('descripcion'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('descripcion') }}</strong>
                        </span>
                    @endif

                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-9 offset-md-3">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>

    </div>
@endsection
