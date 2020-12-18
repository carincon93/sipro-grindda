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

            <p class="mt-5 pl-4">Evaluación de aliados</p>
            <h3 class="descripcion-objetivo-especifico">{{ $proyecto->titulo }}</h3>

            @forelse ($proyecto->aliados as $key => $aliado)
                <form action="{{ route('evaluacion.guardarEvaluacionAliados', $proyecto->id) }}" method="POST" @submit.prevent="guardarEvaluacionAjax" data-id="{{ $aliado->id }}" data-item="aliado">
                    @csrf
                    <div class="datos-planeacion shadow p-4">
                        <div class="col-md-12">
                            <div class="row">
                                <label class="col-md-3 col-form-label text-md-left" for=""><strong>Nombre del aliado</strong></label>
                                <div class="col-md-7">
                                    <p>
                                        {{ $aliado->nombreAliado }}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label text-md-left" for=""><strong>NIT</strong></label>
                                <div class="col-md-7">
                                    <p>
                                        {{ $aliado->nit }}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label text-md-left" for=""><strong>Recursos en especie</strong></label>
                                <div class="col-md-7">
                                    <p>
                                        $ {{ number_format($aliado->recursosEspecie, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label text-md-left" for=""><strong>Recursos en dinero</strong></label>
                                <div class="col-md-7">
                                    <p>
                                        $ {{ number_format($aliado->recursosDinero, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label text-md-left" for=""><strong>Carta de compromiso</strong></label>
                                <div class="col-md-7">
                                    <p>
                                        <a href="{{ route('aliados.descargarCartaConvenio', $aliado->id) }}"><i class="far fa-arrow-alt-circle-down"></i> Descargar carta de convenio</a>
                                    </p>
                                </div>
                            </div>

                            <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                <label class="col-md-3" for="recomendacion-aliado{{ $aliado->id }}">Recomendación</label>
                                <div class="col-md-7">
                                    <textarea id="recomendacion-aliado{{ $aliado->id }}" name="recomendacionAliado" rows="6" cols="80" class="form-control">{{ $aliado->obtenerRecomendacion($aliado->id, 'aliado') != null ? $aliado->obtenerRecomendacion($aliado->id, 'aliado')->recomendacion : '' }}</textarea>
                                    <input type="hidden" name="idAliado" value="{{ $aliado->id }}">
                                </div>
                            </div>

                            @if ($proyecto->modificado)
                                <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                    <label class="col-md-3" for="cumplimiento-aliado{{ $aliado->id }}">
                                        ¿Cumple?
                                    </label>
                                    <div class="col-md-7">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            @if ($aliado->obtenerRecomendacion($aliado->id, 'aliado'))
                                                <input type="radio" name="cumplimientoAliado" id="cumple-si{{ $aliado->id }}" value="si" class="custom-control-input" {{ $aliado->obtenerRecomendacion($aliado->id, 'aliado')->cumplimiento == 'si' ? 'checked' : '' }}>
                                            @else
                                                <input type="radio" name="cumplimientoAliado" id="cumple-si{{ $aliado->id }}" value="si" class="custom-control-input">
                                            @endif
                                            <label class="custom-control-label" for="cumple-si{{ $aliado->id }}">Si</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            @if ($aliado->obtenerRecomendacion($aliado->id, 'aliado'))
                                                <input type="radio" name="cumplimientoAliado" id="cumple-no{{ $aliado->id }}" value="no" class="custom-control-input" {{ $aliado->obtenerRecomendacion($aliado->id, 'aliado')->cumplimiento == 'no' ? 'checked' : '' }}>
                                            @else
                                                <input type="radio" name="cumplimientoAliado" id="cumple-no{{ $aliado->id }}" value="no" class="custom-control-input">
                                            @endif
                                            <label class="custom-control-label" for="cumple-no{{ $aliado->id }}">No</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-7 offset-3">
                                    <button id="aliado{{ $aliado->id }}" type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @empty
                <p class="pl-5 mb-2">No hay aliados empresariales asociados</p>
            @endforelse

            <div class="datos-planeacion shadow p-4">
                <div class="col-md-9 offset-md-3">
                    <a class="btn btn-primary" href="{{ route('evaluacion.evaluarRecursosHumanos', $proyecto->id) }}">Continuar</a>
                    {{-- <button type="submit" class="btn btn-primary">Guardar evaluación de aliados</button> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="loading" v-show="loading">
        <i class="fa fa-spinner fa-spin p-lg-2"></i> Cargando
    </div>
@endsection
