@extends('layouts.app')

@section('body_class', 'panel-planeacion')

@section('content')

    <div class="tab-content" id="pills-tabContent">

        @include('partials.menu-evaluacion', ['proyecto' => $proyecto])

        @push('planeacion')
            @include('partials.navbar-evaluacion-tecnica')
        @endpush

        @include('partials.messages')

        <div class="tab-content panel-principal">

            <p class="mt-5 pl-4">Evaluación de actividades</p>
            <h3 class="descripcion-objetivo-especifico">{{ $proyecto->titulo }}</h3>

            @foreach ($proyecto->objetivosEspecificos as $key => $objetivoEspecifico)
                @foreach ($objetivoEspecifico->resultados as $resultado)
                    @foreach ($resultado->productos as $producto)
                        @foreach ($producto->actividades as $actividad)
                            <form action="{{ route('evaluacion.guardarEvaluacionActividades', $proyecto->id) }}" method="POST" @submit.prevent="guardarEvaluacionAjax" data-id="{{ $actividad->id }}" data-item="actividad">
                                @csrf
                                {{-- @method('PUT') --}}
                                <div class="datos-planeacion shadow p-4">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label text-md-left" for=""><strong>Descripción</strong></label>
                                            <div class="col-md-7">
                                                <p>
                                                    {{ $actividad->descripcion }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-3 col-form-label text-md-left" for=""><strong>Fecha de inicio</strong></label>
                                            <div class="col-md-7">
                                                <p class="fecha">
                                                    {{ $actividad->fechaInicio }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-3 col-form-label text-md-left" for=""><strong>Fecha de fin</strong></label>
                                            <div class="col-md-7">
                                                <p class="fecha">
                                                    {{ $actividad->fechaFin }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-3 col-form-label text-md-left" for=""><strong>Duración</strong></label>
                                            <div class="col-md-7">
                                                <p>
                                                    {{ $actividad->duracion }} días
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                            <label class="col-md-3" for="recomendacion-actividad{{ $actividad->id }}">Recomendación</label>
                                            <div class="col-md-7">
                                                <textarea id="recomendacion-actividad{{ $actividad->id }}" name="recomendacionActividad" rows="6" cols="80" class="form-control">{{ $actividad->obtenerRecomendacion($actividad->id, 'actividad') != null ? $actividad->obtenerRecomendacion($actividad->id, 'actividad')->recomendacion : '' }}</textarea>
                                                <input type="hidden" name="idActividad" value="{{ $actividad->id }}">
                                            </div>
                                        </div>

                                        @if ($proyecto->modificado)
                                            <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                                <label class="col-md-3" for="cumplimiento-actividad{{ $actividad->id }}">
                                                    ¿Cumple?
                                                </label>
                                                <div class="col-md-7">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        @if ($actividad->obtenerRecomendacion($actividad->id, 'actividad'))
                                                            <input type="radio" name="cumplimientoActividad" id="cumple-si{{ $actividad->id }}" value="si" class="custom-control-input" {{ $actividad->obtenerRecomendacion($actividad->id, 'actividad')->cumplimiento == 'si' ? 'checked' : '' }}>
                                                        @else
                                                            <input type="radio" name="cumplimientoActividad" id="cumple-si{{ $actividad->id }}" value="si" class="custom-control-input">
                                                        @endif
                                                        <label class="custom-control-label" for="cumple-si{{ $actividad->id }}">Si</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        @if ($actividad->obtenerRecomendacion($actividad->id, 'actividad'))
                                                            <input type="radio" name="cumplimientoActividad" id="cumple-no{{ $actividad->id }}" value="no" class="custom-control-input" {{ $actividad->obtenerRecomendacion($actividad->id, 'actividad')->cumplimiento == 'no' ? 'checked' : '' }}>
                                                        @else
                                                            <input type="radio" name="cumplimientoActividad" id="cumple-no{{ $actividad->id }}" value="no" class="custom-control-input">
                                                        @endif
                                                        <label class="custom-control-label" for="cumple-no{{ $actividad->id }}">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-7 offset-3">
                                                <button id="actividad{{ $actividad->id }}" type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endforeach
                    @endforeach
                @endforeach
            @endforeach
            <div class="datos-planeacion shadow p-4">
                <div class="col-md-9 offset-md-3">
                    <a class="btn btn-primary" href="{{ route('evaluacion.evaluarAliados', $proyecto->id) }}">Continuar</a>
                    {{-- <button type="submit" class="btn btn-primary">Guardar evaluación de actividades</button> --}}
                </div>
            </div>

        </div>
    </div>
    <div class="loading" v-show="loading">
        <i class="fa fa-spinner fa-spin p-lg-2"></i> Cargando
    </div>
@endsection
