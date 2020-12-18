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

            <p class="mt-5 pl-4">Evaluación de presupuestos</p>
            <h3 class="descripcion-objetivo-especifico">{{ $proyecto->titulo }}</h3>

            @forelse ($proyecto->presupuestos as $key => $presupuesto)
                <form action="{{ route('evaluacion.guardarEvaluacionPresupuestoSENNOVA', $proyecto->id) }}" method="POST" @submit.prevent="guardarEvaluacionAjax" data-id="{{ $presupuesto->id }}" data-item="presupuesto">
                    @csrf
                    <div class="datos-planeacion shadow p-4">
                        <div class="col-md-12">
                            <div class="row">
                                <label class="col-md-3 col-form-label text-md-left" for=""><strong>Nombre del rubro</strong></label>
                                <div class="col-md-7">
                                    <p>
                                        {{ $presupuesto->nombreItem }}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label text-md-left" for=""><strong>Valor</strong></label>
                                <div class="col-md-7">
                                    <p>
                                        $ {{number_format($presupuesto->valor, 0, ',', '.')}}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label text-md-left" for=""><strong>Descripción</strong></label>
                                <div class="col-md-7">
                                    <p>
                                        {{ $presupuesto->descripcion }}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label text-md-left" for=""><strong>Anexo</strong></label>
                                <div class="col-md-7">
                                    <a href="{{ route('presupuestos_sennova.descargarCartaPresupuesto', $presupuesto->id) }}"><i class="far fa-arrow-alt-circle-down"></i> Descargar anexo</a>
                                </div>
                            </div>

                            <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                <label class="col-md-3" for="recomendacion-presupuesto{{ $presupuesto->id }}">Recomendación</label>
                                <div class="col-md-7">
                                    <textarea id="recomendacion-presupuesto{{ $presupuesto->id }}" name="recomendacionPresupuestoSENNOVA" rows="6" cols="80" class="form-control">{{ $presupuesto->obtenerRecomendacion($presupuesto->id, 'presupuestoSennova') != null ? $presupuesto->obtenerRecomendacion($presupuesto->id, 'presupuestoSennova')->recomendacion : '' }}</textarea>
                                    <input type="hidden" name="idPresupuestoSENNOVA" value="{{ $presupuesto->id }}">
                                </div>
                            </div>

                            @if ($proyecto->modificado)
                                <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                    <label class="col-md-3" for="cumplimiento-presupuesto-sennova{{ $presupuesto->id }}">
                                        ¿Cumple?
                                    </label>
                                    <div class="col-md-7">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            @if ($presupuesto->obtenerRecomendacion($presupuesto->id, 'presupuestoSennova'))
                                                <input type="radio" name="cumplimientoPresupuestoSennova" id="cumple-si{{ $presupuesto->id }}" value="si" class="custom-control-input" {{ $presupuesto->obtenerRecomendacion($presupuesto->id, 'presupuestoSennova')->cumplimiento == 'si' ? 'checked' : '' }}>
                                            @else
                                                <input type="radio" name="cumplimientoPresupuestoSennova" id="cumple-si{{ $presupuesto->id }}" value="si" class="custom-control-input">
                                            @endif
                                            <label class="custom-control-label" for="cumple-si{{ $presupuesto->id }}">Si</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            @if ($presupuesto->obtenerRecomendacion($presupuesto->id, 'presupuestoSennova'))
                                                <input type="radio" name="cumplimientoPresupuestoSennova" id="cumple-no{{ $presupuesto->id }}" value="no" class="custom-control-input" {{ $presupuesto->obtenerRecomendacion($presupuesto->id, 'presupuestoSennova')->cumplimiento == 'no' ? 'checked' : '' }}>
                                            @else
                                                <input type="radio" name="cumplimientoPresupuestoSennova" id="cumple-no{{ $presupuesto->id }}" value="no" class="custom-control-input">
                                            @endif
                                            <label class="custom-control-label" for="cumple-no{{ $presupuesto->id }}">No</label>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-7 offset-3">
                                    <button id="presupuesto{{ $presupuesto->id }}" type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @empty
                <p class="pl-5 mb-2">No tiene presupuestos de SENNOVA asociados</p>
            @endforelse

            <div class="datos-planeacion shadow p-4">
                <div class="col-md-9 offset-md-3">
                    {{-- <button type="submit" class="btn btn-primary">Guardar evaluación de presupuestos</button> --}}
                    <a class="btn btn-primary" href="{{ route('evaluacion.enviarEvaluacion', $proyecto->id) }}">Continuar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="loading" v-show="loading">
        <i class="fa fa-spinner fa-spin p-lg-2"></i> Cargando
    </div>
@endsection
