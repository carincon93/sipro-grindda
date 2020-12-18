@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('convocatorias.update', $convocatoria->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label class="col-md-3" for="fecha_inicio">Fecha de inicio de la convocatoria <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="fecha_inicio" type="date" name="fecha_inicio" class="form-control{{ $errors->has('fecha_inicio') ? ' is-invalid' : '' }}" value="{{ $convocatoria->fecha_inicio }}" required>

                    @if ($errors->has('fecha_inicio'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('fecha_inicio') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="fecha_fin">Fecha de fin de la convocatoria <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="fecha_fin" type="date" name="fecha_fin" class="form-control{{ $errors->has('fecha_fin') ? ' is-invalid' : '' }}" value="{{ $convocatoria->fecha_fin }}" required>

                    @if ($errors->has('fecha_fin'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('fecha_fin') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="descripcion">Descripción <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="4" cols="80" required>{{ $convocatoria->descripcion }}</textarea>

                    @if ($errors->has('descripcion'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('descripcion') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="fecha_fin" class="col-md-3">Tipo de convocatoria <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <div class="custom-control custom-radio">
                        <input id="convocatoriaCreacionProyectos" type="radio" name="tipoConvocatoria" value="0" class="custom-control-input" {{ $convocatoria->convocatoriaCorreccion == false ? 'checked' : '' }} required>
                        <label class="custom-control-label convocatoriaCreacionProyectos" for="convocatoriaCreacionProyectos">
                            Convocatoria para formulación de proyectos
                        </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="convocatoriaCorrecionProyectos" type="radio" name="tipoConvocatoria" value="1" class="custom-control-input" {{ $convocatoria->convocatoriaCorreccion == true ? 'checked' : '' }} required>
                        <label class="custom-control-label convocatoriaCorrecionProyectos" for="convocatoriaCorrecionProyectos">
                            Convocatoria para correción de proyectos
                        </label>
                    </div>

                    @if ($errors->has('tipoConvocatoria'))
                        <span class="invalid-feedback d-block">
                            <strong>{{ $errors->first('tipoConvocatoria') }}</strong>
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
