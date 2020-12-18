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

            <p class="mt-5 pl-4">Evaluación de resultados</p>
            <h3 class="descripcion-objetivo-especifico">{{ $proyecto->titulo }}</h3>

            @foreach ($proyecto->objetivosEspecificos as $key => $objetivoEspecifico)
                @foreach ($objetivoEspecifico->resultados as $resultado)
                    <form action="{{ route('evaluacion.guardarEvaluacionResultados', $proyecto->id) }}" method="POST" @submit.prevent="guardarEvaluacionAjax" data-id="{{ $resultado->id }}" data-item="resultado">
                        @csrf
                        <div class="datos-planeacion shadow p-4">
                            <div class="col-md-12">
                                <div class="row">
                                    <label class="col-md-3 col-form-label text-md-left" for=""><strong>Resultado</strong></label>
                                    <div class="col-md-7">
                                        <p>
                                            {{ $resultado->descripcion }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label text-md-left" for=""><strong>Indicador</strong></label>
                                    <div class="col-md-7">
                                        <p>
                                            {{ $resultado->indicador }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label text-md-left" for=""><strong>Medio de verificación</strong></label>
                                    <div class="col-md-7">
                                        <p>
                                            {{ $resultado->medioVerificacion }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label text-md-left" for=""><strong>Meta</strong></label>
                                    <div class="col-md-7">
                                        <p>
                                            {{ $resultado->meta }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                    <label class="col-md-3" for="recomendacion-resultado{{ $key + 1 }}">
                                        Recomendación
                                        {{-- <div id="resultado{{ $resultado->id }}" class="text-success"></div> --}}
                                    </label>
                                    <div class="col-md-7">
                                        <textarea id="recomendacion-resultado{{ $key + 1 }}" name="recomendacionResultado" rows="6" cols="80" class="form-control" data-resultadoid="{{ $resultado->id }}" data-proyectoid="{{ $proyecto->id }}">{{ $resultado->obtenerRecomendacion($resultado->id, 'resultado') != null ? $resultado->obtenerRecomendacion($resultado->id, 'resultado')->recomendacion : '' }}</textarea>
                                        <input type="hidden" name="idResultado" value="{{ $resultado->id }}">
                                    </div>
                                </div>

                                @if ($proyecto->modificado)
                                    <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                        <label class="col-md-3" for="cumplimiento-resultado{{ $key + 1 }}">
                                            ¿Cumple?
                                            {{-- <div id="resultado{{ $resultado->id }}" class="text-success"></div> --}}
                                        </label>
                                        <div class="col-md-7">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                @if ($resultado->obtenerRecomendacion($resultado->id, 'resultado'))
                                                    <input type="radio" name="cumplimientoResultado" id="cumple-si{{ $key + 1 }}" value="si" class="custom-control-input" {{ $resultado->obtenerRecomendacion($resultado->id, 'resultado')->cumplimiento == 'si' ? 'checked' : '' }}>
                                                @else
                                                    <input type="radio" name="cumplimientoResultado" id="cumple-si{{ $key + 1 }}" value="si" class="custom-control-input">
                                                @endif
                                                <label class="custom-control-label" for="cumple-si{{ $key + 1 }}">Si</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                @if ($resultado->obtenerRecomendacion($resultado->id, 'resultado'))
                                                    <input type="radio" name="cumplimientoResultado" id="cumple-no{{ $key + 1 }}" value="no" class="custom-control-input" {{ $resultado->obtenerRecomendacion($resultado->id, 'resultado')->cumplimiento == 'no' ? 'checked' : '' }}>
                                                @else
                                                    <input type="radio" name="cumplimientoResultado" id="cumple-no{{ $key + 1 }}" value="no" class="custom-control-input">
                                                @endif
                                                <label class="custom-control-label" for="cumple-no{{ $key + 1 }}">No</label>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-7 offset-3">
                                        <button id="resultado{{ $resultado->id }}" type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @endforeach
            @endforeach
            <div class="datos-planeacion shadow p-4">
                <div class="col-md-9 offset-md-3">
                    <a class="btn btn-primary" href="{{ route('evaluacion.evaluarProductos', $proyecto->id) }}">Continuar</a>
                    {{-- <button type="submit" class="btn btn-primary">Guardar evaluación de resultados</button> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="loading" v-show="loading">
        <i class="fa fa-spinner fa-spin p-lg-2"></i> Cargando
    </div> --}}
@endsection
