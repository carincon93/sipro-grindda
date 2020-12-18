@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ route('programas_formacion.store') }}" method="POST">
            @csrf

            <div class="form-group row">
                <label class="col-md-3" for="nombre">Nombre del programa de formación <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="nombre" type="text" name="nombre" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}" value="{{ old('nombre') }}" autocomplete="off" maxlength="191" required>

                    @if ($errors->has('nombre'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3" for="nivelAcademico">Nivel académico <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <select name="nivelAcademico" id="nivelAcademico" class="form-control {{ $errors->has('nivelAcademico') ? ' is-invalid' : '' }}" required>
                        <option value="">Seleccione el nivel académico</option>
                        <option value="técnico" {{ old('nivelAcademico') == 'técnico' ? 'selected' : '' }}>Técnico</option>
                        <option value="tecnólogo" {{ old('nivelAcademico') == 'tecnólogo' ? 'selected' : '' }}>Tecnólogo</option>
                        <option value="especialización" {{ old('nivelAcademico') == 'especialización' ? 'selected' : '' }}>Especialización</option>
                    </select>

                    @if ($errors->has('nivelAcademico'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('nivelAcademico') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3" for="sectorProductivo">Sector productivo <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="sectorProductivo" type="text" name="sectorProductivo" class="form-control {{ $errors->has('sectorProductivo') ? ' is-invalid' : '' }}" value="{{ old('sectorProductivo') }}" autocomplete="off" maxlength="191" required>

                    @if ($errors->has('sectorProductivo'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('sectorProductivo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-9 offset-md-3">
                    <button type="submit" class="btn btn-primary">Guardar programa de formación</button>
                </div>
            </div>
        </form>

    </div>
@endsection
