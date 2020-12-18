@extends('layouts.app')

@section('body_class', 'panel-planeacion')

@section('content')

    <div class="tab-content" id="pills-tabContent">

        @include('partials.menu-evaluacion-criterios', ['proyecto' => $proyecto, 'criterios' => $criterios])

        @push('planeacion')
            @include('partials.navbar-evaluacion-tecnica')
        @endpush

        @include('partials.messages')

        <div class="tab-content  panel-principal">

            <p class="mt-5 pl-4"></p>
            <div class="descripcion-objetivo-especifico">
                <h3>
                    {{ $proyecto->titulo }}
                </h3>
                @can ('descargar-evaluacion', $proyecto)
                    <a href="{{ route('evaluacion.descargarExcelEvaluacion', $proyecto->id) }}" class="btn btn-success background-success text-light"><i class="fas fa-file-excel"></i> Descargar excel</a>
                @else
                    <a href="#" class="btn btn-dark disabled"><i class="fas fa-file-excel"></i> Descargar excel</a>
                @endcan
            </div>

            <form action="{{ route('evaluacion.guardarEvaluacionCriterio', $proyecto->id) }}" method="POST">
                @csrf
                <input type="hidden" name="criterio" value="{{ $criterio->nombreCriterio }}">
                <input type="hidden" name="criterioPuntajeMaximo" value="{{ $criterio->puntajeMaximo }}">
                <div class="datos-planeacion shadow p-4">
                    <h3>Criterio a evaluar: <strong>{{ $criterio->nombreCriterio }}</strong></h3>
                    <p>Puntaje máximo <strong>{{ $criterio->puntajeMaximo }}</strong></p>
                    @foreach ($criterio->subcriterios as $key => $subcriterio)

                        <hr>

                        <p>{{ $subcriterio->descripcionSubcriterio }}</p>
                        <input type="hidden" name="ids[]" value="{{ $subcriterio->id }}">

                        <div class="form-group row">
                            <label for="item{{ $key + 1 }}" class="col-md-3">Seleccione el estado del item <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <select id="item{{ $key + 1 }}" class="form-control{{ $errors->has('item.'.$key) ? ' is-invalid' : '' }}" name="item[]" required>
                                    <option value="">Seleccione una opción</option>
                                    {{-- <option value="Satisfactorio" {{ old('item.'.$key) == 'Satisfactorio' ? 'selected' : '' }} >Satisfactorio</option>
                                    <option value="Requiere modificaciones" {{ old('item.'.$key) == 'Requiere modificaciones' ? 'selected' : '' }} >Requiere modificaciones</option>
                                    <option value="No cumple" {{ old('item.'.$key) == 'No cumple' ? 'selected' : '' }} >No cumple / No se evidencia</option> --}}
                                    <option value="Satisfactorio" {{ $proyecto->obtenerCriteriosYSubcriteriosEvaluados($subcriterio->id) !== null && $proyecto->obtenerCriteriosYSubcriteriosEvaluados($subcriterio->id)->estado == 'Satisfactorio' ? 'selected' : '' }}>Satisfactorio</option>
                                    <option value="Requiere modificaciones" {{ $proyecto->obtenerCriteriosYSubcriteriosEvaluados($subcriterio->id) !== null && $proyecto->obtenerCriteriosYSubcriteriosEvaluados($subcriterio->id)->estado == 'Requiere modificaciones' ? 'selected' : '' }}>Requiere modificaciones</option>
                                    <option value="No cumple" {{ $proyecto->obtenerCriteriosYSubcriteriosEvaluados($subcriterio->id) !== null && $proyecto->obtenerCriteriosYSubcriteriosEvaluados($subcriterio->id)->estado == 'No cumple' ? 'selected' : '' }}>No cumple / No se evidencia</option>
                                </select>

                                @if ($errors->has('item.'.$key))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('item.'.$key) }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="puntajeAsignadoItem{{ $key + 1 }}" class="col-md-3">Asignar puntaje <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <select id="puntajeAsignadoItem{{ $key + 1 }}" class="form-control{{ $errors->has('puntajeAsignadoItem.'.$key) ? ' is-invalid' : '' }}" name="puntajeAsignadoItem[]" required>
                                    <option value="">Seleccione una opción</option>
                                    <option value="0" {{ $proyecto->obtenerCriteriosYSubcriteriosEvaluados($subcriterio->id) !== null && $proyecto->obtenerCriteriosYSubcriteriosEvaluados($subcriterio->id)->puntajeAsignado == 0 ? 'selected' : '' }}>0</option>
                                    @for ($i=1; $i <= $criterio->puntajeMaximo; $i++)
                                        {{-- <option value="{{ $i }}" {{ old('puntajeAsignadoItem.'.$key) == $i ? 'selected' : '' }}>{{ $i }}</option> --}}
                                        <option value="{{ $i }}" {{ $proyecto->obtenerCriteriosYSubcriteriosEvaluados($subcriterio->id) !== null && $proyecto->obtenerCriteriosYSubcriteriosEvaluados($subcriterio->id)->puntajeAsignado == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>

                                @if ($errors->has('puntajeAsignadoItem.'.$key))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('puntajeAsignadoItem.'.$key) }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <div class="form-group row">
                        <label for="observacionCriterio" class="col-md-3">Observación del criterio <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <textarea id="observacionCriterio" name="observacionCriterio" rows="8" cols="80" class="form-control{{ $errors->has('observacionCriterio') ? ' is-invalid' : '' }}" required>{{ $proyecto->obtenerRecomendacionCriterio($criterio->nombreCriterio) !== null ? $proyecto->obtenerRecomendacionCriterio($criterio->nombreCriterio)->observacion : '' }}</textarea>

                            @if ($errors->has('observacionCriterio'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('observacionCriterio') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        {{-- <div class="col-md-3">
                            <p class="small">Después de guardar</p>
                        </div> --}}
                        <div class="col-md-6 offset-md-3">
                            <p id="suma"></p>
                            <button id="guardarEvaluacionCriterio" type="submit" class="btn btn-primary">Guardar evaluación <strong>{{ $criterio->nombreCriterio }}</strong></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
