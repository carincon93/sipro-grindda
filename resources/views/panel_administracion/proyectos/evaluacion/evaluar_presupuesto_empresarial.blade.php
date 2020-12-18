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

            <p class="mt-5 pl-4">Evaluación del presupuesto empresarial</p>
            <h3 class="descripcion-objetivo-especifico">{{ $proyecto->titulo }}</h3>

            @forelse ($proyecto->aliados as $key => $aliado)
                @forelse ($aliado->presupuestosEmpresariales as $presupuestoEmpresarial)
                    <form action="{{ route('evaluacion.guardarEvaluacionPresupuestoEmpresarial', $proyecto->id) }}" method="POST" @submit.prevent="guardarEvaluacionAjax" data-id="{{ $presupuestoEmpresarial->id }}" data-item="presupuestoEmpresarial">
                        @csrf
                        {{-- @method('PUT') --}}
                        <div class="datos-planeacion shadow p-4">
                            <div class="col-md-12">
                                <div class="row">
                                    <label class="col-md-3 col-form-label text-md-left" for=""><strong>Aliado empresarial</strong></label>
                                    <div class="col-md-7">
                                        <p>
                                            {{ $aliado->nombreAliado }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label text-md-left" for=""><strong>Nombre del rubro</strong></label>
                                    <div class="col-md-7">
                                        <p>
                                            {{ $presupuestoEmpresarial->nombreItem }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label text-md-left" for=""><strong>Valor</strong></label>
                                    <div class="col-md-7">
                                        <p>
                                            $ {{ number_format($presupuestoEmpresarial->valor, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label text-md-left" for=""><strong>Descripción</strong></label>
                                    <div class="col-md-7">
                                        <p>
                                            {{ $presupuestoEmpresarial->descripcion }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label text-md-left" for=""><strong>Anexo</strong></label>
                                    <div class="col-md-7">
                                        <p>
                                            <a href="{{ route('presupuestos_empresariales.descargarCartaPresupuesto', $presupuestoEmpresarial->id) }}"><i class="far fa-arrow-alt-circle-down"></i> Descargar anexo</a>
                                        </p>
                                    </div>
                                </div>

                                <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                    <label class="col-md-3" for="recomendacion-presupuesto-empresarial{{ $presupuestoEmpresarial->id }}">Recomendación</label>
                                    <div class="col-md-7">
                                        <textarea id="recomendacion-presupuesto-empresarial{{ $presupuestoEmpresarial->id }}" name="recomendacionPresupuestoEmpresarial" rows="6" cols="80" class="form-control">{{ $presupuestoEmpresarial->obtenerRecomendacion($presupuestoEmpresarial->id, 'presupuestoEmpresarial') != null ? $presupuestoEmpresarial->obtenerRecomendacion($presupuestoEmpresarial->id, 'presupuestoEmpresarial')->recomendacion : '' }}</textarea>
                                        <input type="hidden" name="idPresupuestoEmpresarial" value="{{ $presupuestoEmpresarial->id }}">
                                    </div>
                                </div>

                                @if ($proyecto->modificado)
                                    <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                        <label class="col-md-3" for="cumplimiento-presupuesto-empresarial{{ $presupuestoEmpresarial->id }}">
                                            ¿Cumple?
                                        </label>
                                        <div class="col-md-7">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                @if ($presupuestoEmpresarial->obtenerRecomendacion($presupuestoEmpresarial->id, 'presupuestoEmpresarial'))
                                                    <input type="radio" name="cumplimientoPresupuestoEmpresarial" id="cumple-si{{ $presupuestoEmpresarial->id }}" value="si" class="custom-control-input" {{ $presupuestoEmpresarial->obtenerRecomendacion($presupuestoEmpresarial->id, 'presupuestoEmpresarial')->cumplimiento == 'si' ? 'checked' : '' }}>
                                                @else
                                                    <input type="radio" name="cumplimientoPresupuestoEmpresarial" id="cumple-si{{ $presupuestoEmpresarial->id }}" value="si" class="custom-control-input">
                                                @endif
                                                <label class="custom-control-label" for="cumple-si{{ $presupuestoEmpresarial->id }}">Si</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                @if ($presupuestoEmpresarial->obtenerRecomendacion($presupuestoEmpresarial->id, 'presupuestoEmpresarial'))
                                                    <input type="radio" name="cumplimientoPresupuestoEmpresarial" id="cumple-no{{ $presupuestoEmpresarial->id }}" value="no" class="custom-control-input" {{ $presupuestoEmpresarial->obtenerRecomendacion($presupuestoEmpresarial->id, 'presupuestoEmpresarial')->cumplimiento == 'no' ? 'checked' : '' }}>
                                                @else
                                                    <input type="radio" name="cumplimientoPresupuestoEmpresarial" id="cumple-no{{ $presupuestoEmpresarial->id }}" value="no" class="custom-control-input">
                                                @endif
                                                <label class="custom-control-label" for="cumple-no{{ $presupuestoEmpresarial->id }}">No</label>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-7 offset-3">
                                        <button id="presupuestoEmpresarial{{ $presupuestoEmpresarial->id }}" type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @empty
                    <p class="pl-5 mb-2">No hay presupuestos empresariales asociados</p>
                @endforelse
            @empty
                <p class="pl-5 mb-2">No hay alianzas empresariales asociadas</p>
            @endforelse

            <div class="datos-planeacion shadow p-4">
                <div class="col-md-9 offset-md-3">
                    {{-- <button type="submit" class="btn btn-primary">Guardar evaluación del presupuesto empresarial</button> --}}
                    <a class="btn btn-primary" href="{{ route('evaluacion.evaluarPresupuestoSENNOVA', $proyecto->id) }}">Continuar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="loading" v-show="loading">
        <i class="fa fa-spinner fa-spin p-lg-2"></i> Cargando
    </div>
@endsection
