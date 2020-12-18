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

            <p class="mt-5 pl-4">Evaluación de personal</p>
            <h3 class="descripcion-objetivo-especifico">{{ $proyecto->titulo }}</h3>


            @forelse ($proyecto->recursosHumanos as $key => $recursoHumano)
                <form action="{{ route('evaluacion.guardarEvaluacionRecursosHumanos', $proyecto->id) }}" method="POST" @submit.prevent="guardarEvaluacionAjax" data-id="{{ $recursoHumano->id }}" data-item="recursoHumano">
                    @csrf
                    {{-- @method('PUT') --}}
                    <div class="datos-planeacion shadow p-4">
                        <div class="col-md-12">
                            <div class="row">
                                <label class="col-md-3 col-form-label text-md-left" for=""><strong>Nombre</strong></label>
                                <div class="col-md-7">
                                    <p>
                                        {{ $recursoHumano->nombrePersonal }}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label text-md-left" for=""><strong>Número de documento</strong></label>
                                <div class="col-md-7">
                                    <p>
                                        {{ $recursoHumano->numeroDocumentoPersonal }}
                                    </p>
                                </div>
                            </div>
                            @if($recursoHumano->personalInstructor)
                                <div class="row">
                                    <label class="col-md-3 col-form-label text-md-left" for=""><strong>Tipo de personal</strong></label>
                                    <div class="col-md-7">
                                        <p>
                                            Instructor
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label text-md-left" for=""><strong>Carta de compromiso</strong></label>
                                    <div class="col-md-7">
                                        <p>
                                            <a href="{{ route('recursos_humanos.descargarCartaCompromiso', $recursoHumano->id) }}"><i class="far fa-arrow-alt-circle-down"></i> Descargar carta de compromiso</a>
                                        </p>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <label class="col-md-3 col-form-label text-md-left" for=""><strong>Tipo de personal</strong></label>
                                    <div class="col-md-7">
                                        <p>
                                            Interno
                                        </p>
                                    </div>
                                </div>
                            @endif

                            <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                <label class="col-md-3" for="recomendacion-recurso-humano{{ $recursoHumano->id }}">Recomendación</label>
                                <div class="col-md-7">
                                    <textarea id="recomendacion-recurso-humano{{ $recursoHumano->id }}" name="recomendacionRecursoHumano" rows="6" cols="80" class="form-control">{{ $recursoHumano->obtenerRecomendacion($recursoHumano->id, 'personal') != null ? $recursoHumano->obtenerRecomendacion($recursoHumano->id, 'personal')->recomendacion : '' }}</textarea>
                                    <input type="hidden" name="idRecursoHumano" value="{{ $recursoHumano->id }}">
                                </div>
                            </div>

                            @if ($proyecto->modificado)
                                <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                    <label class="col-md-3" for="cumplimiento-recursp-humano{{ $recursoHumano->id }}">
                                        ¿Cumple?
                                    </label>
                                    <div class="col-md-7">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            @if ($recursoHumano->obtenerRecomendacion($recursoHumano->id, 'personal'))
                                                <input type="radio" name="cumplimientoRecursoHumano" id="cumple-si{{ $recursoHumano->id }}" value="si" class="custom-control-input" {{ $recursoHumano->obtenerRecomendacion($recursoHumano->id, 'personal')->cumplimiento == 'si' ? 'checked' : '' }}>
                                            @else
                                                <input type="radio" name="cumplimientoRecursoHumano" id="cumple-si{{ $recursoHumano->id }}" value="si" class="custom-control-input">
                                            @endif
                                            <label class="custom-control-label" for="cumple-si{{ $recursoHumano->id }}">Si</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            @if ($recursoHumano->obtenerRecomendacion($recursoHumano->id, 'personal'))
                                                <input type="radio" name="cumplimientoRecursoHumano" id="cumple-no{{ $recursoHumano->id }}" value="no" class="custom-control-input" {{ $recursoHumano->obtenerRecomendacion($recursoHumano->id, 'personal')->cumplimiento == 'no' ? 'checked' : '' }}>
                                            @else
                                                <input type="radio" name="cumplimientoRecursoHumano" id="cumple-no{{ $recursoHumano->id }}" value="no" class="custom-control-input">
                                            @endif
                                            <label class="custom-control-label" for="cumple-no{{ $recursoHumano->id }}">No</label>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-7 offset-3">
                                    <button id="recursoHumano{{ $recursoHumano->id }}" type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @empty
                <p>No hay personal asociado</p>
            @endforelse

            <div class="datos-planeacion shadow p-4">
                <div class="col-md-9 offset-md-3">
                    <a class="btn btn-primary" href="{{ route('evaluacion.evaluarPresupuestoEmpresarial', $proyecto->id) }}">Continuar</a>
                    {{-- <button type="submit" class="btn btn-primary">Guardar evaluación del personal</button> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="loading" v-show="loading">
        <i class="fa fa-spinner fa-spin p-lg-2"></i> Cargando
    </div>
@endsection
