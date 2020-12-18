@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('grupos_investigacion.update', $grupoInvestigacion->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label class="col-md-3" for="nombreGrupoInvestigacion">Nombre del Grupo de Investigación <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="nombreGrupoInvestigacion" type="text" name="nombre" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" value="{{ $grupoInvestigacion->nombre }}" required>

                    @if ($errors->has('nombre'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                    @endif

                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="descripcionGrupoInvestigacion">Descripción del Grupo de Investigación <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <textarea id="descripcionGrupoInvestigacion" name="descripcion" rows="4" cols="80" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" required>{{ $grupoInvestigacion->descripcion }}</textarea>

                    @if ($errors->has('descripcion'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('descripcion') }}</strong>
                        </span>
                    @endif

                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-9 offset-md-3">
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </form>

    </div>
@endsection
