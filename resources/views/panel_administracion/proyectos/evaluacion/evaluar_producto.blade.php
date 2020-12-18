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

            <p class="mt-5 pl-4">Evaluación de productos</p>
            <h3 class="descripcion-objetivo-especifico">{{ $proyecto->titulo }}</h3>

            @foreach ($proyecto->objetivosEspecificos as $key => $objetivoEspecifico)
                @foreach ($objetivoEspecifico->resultados as $resultado)
                    @foreach ($resultado->productos as $producto)
                        <form action="{{ route('evaluacion.guardarEvaluacionProductos', $proyecto->id) }}" method="POST" @submit.prevent="guardarEvaluacionAjax" data-id="{{ $producto->id }}" data-item="producto">
                            @csrf
                            <div class="datos-planeacion shadow p-4">
                                <div class="col-md-12">
                                    <div class="row">
                                        <label class="col-md-3 col-form-label text-md-left" for=""><strong>Descripción</strong></label>
                                        <div class="col-md-7">
                                            <p>
                                                {{ $producto->descripcion }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-3 col-form-label text-md-left" for=""><strong>Fecha de inicio</strong></label>
                                        <div class="col-md-7">
                                            <p class="fecha">
                                                {{ $producto->fechaInicio }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-3 col-form-label text-md-left" for=""><strong>Fecha de fin</strong></label>
                                        <div class="col-md-7">
                                            <p class="fecha">
                                                {{ $producto->fechaFin }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-3 col-form-label text-md-left" for=""><strong>Duración</strong></label>
                                        <div class="col-md-7">
                                            <p>
                                                {{ $producto->duracion }} mes(es)
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                        <label class="col-md-3" for="recomendacion-producto{{ $producto->id }}">Recomendación</label>
                                        <div class="col-md-7">
                                            <textarea id="recomendacion-producto{{ $producto->id }}"name="recomendacionProducto" rows="6" cols="80" class="form-control">{{ $producto->obtenerRecomendacion($producto->id, 'producto') !== null ? $producto->obtenerRecomendacion($producto->id, 'producto')->recomendacion : '' }}</textarea>
                                            <input type="hidden" name="idProducto" value="{{ $producto->id }}">
                                        </div>
                                    </div>

                                    @if ($proyecto->modificado)
                                        <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                            <label class="col-md-3" for="cumplimiento-producto{{ $producto->id }}">
                                                ¿Cumple?
                                            </label>
                                            <div class="col-md-7">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    @if ($producto->obtenerRecomendacion($producto->id, 'producto'))
                                                        <input type="radio" name="cumplimientoProducto" id="cumple-si{{ $producto->id }}" value="si" class="custom-control-input" {{ $producto->obtenerRecomendacion($producto->id, 'producto')->cumplimiento == 'si' ? 'checked' : '' }}>
                                                    @else
                                                        <input type="radio" name="cumplimientoProducto" id="cumple-si{{ $producto->id }}" value="si" class="custom-control-input">
                                                    @endif
                                                    <label class="custom-control-label" for="cumple-si{{ $producto->id }}">Si</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    @if ($producto->obtenerRecomendacion($producto->id, 'producto'))
                                                        <input type="radio" name="cumplimientoProducto" id="cumple-no{{ $producto->id }}" value="no" class="custom-control-input" {{ $producto->obtenerRecomendacion($producto->id, 'producto')->cumplimiento == 'no' ? 'checked' : '' }}>
                                                    @else
                                                        <input type="radio" name="cumplimientoProducto" id="cumple-no{{ $producto->id }}" value="no" class="custom-control-input">
                                                    @endif
                                                    <label class="custom-control-label" for="cumple-no{{ $producto->id }}">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-md-7 offset-3">
                                            <button id="producto{{ $producto->id }}" type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endforeach
                @endforeach
            @endforeach
            <div class="datos-planeacion shadow p-4">
                <div class="col-md-9 offset-md-3">
                    <a class="btn btn-primary" href="{{ route('evaluacion.evaluarActividades', $proyecto->id) }}">Continuar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="loading" v-show="loading">
        <i class="fa fa-spinner fa-spin p-lg-2"></i> Cargando
    </div>
@endsection
