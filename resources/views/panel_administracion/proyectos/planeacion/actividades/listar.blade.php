@extends('layouts.app')

@section('body_class', 'panel-planeacion')

@section('content')
    @push('planeacion')
        @component('partials.menu-planeacion', ['proyecto' => $proyecto, 'idObjetivoEspecifico' => $proyecto->objetivosEspecificos->first()->id])

        @endcomponent

    @endpush

    @include('partials.messages')

    <div class="tab-content" id="pills-tabContent">
        <div class="nav flex-column nav-pills panel-izq" id="v-pills-tab-3" role="tablist" aria-orientation="vertical">
            @foreach ($proyecto->objetivosEspecificos as $key => $listaObjetivoEspecifico)
                <a class="nav-link {{ Request::is("panel/ver_planeacion/{$proyecto->id}/actividades/{$listaObjetivoEspecifico->id}") ? 'active' : '' }}" href="{{ route('actividades.show', [$proyecto->id, $listaObjetivoEspecifico->id]) }}">Resultado {{ $key + 1 }}: Actividades asociadas</a>
            @endforeach

            <div class="mt-5">
                <button id="cd-tour-trigger" class="btn btn-transparent d-block mx-auto"><i class="fas fa-question-circle fa-2x text-primary"></i></button>
            </div>
        </div>


        <div class="tab-content panel-principal">
            <div>
                @forelse ($objetivoEspecifico->resultados as $key => $resultado)
                    <a class="btn btn-primary m-4" href="{{ route('actividades.diagrama', $proyecto->id) }}"><i class="far fa-chart-bar"></i> Ver diagrama de Gantt</a>
                    <div class="descripcion-resultado">
                        <span>Descripción del resultado:</span>
                        <p class="h3">
                            {{ $resultado->descripcion }}
                        </p>
                    </div>
                    @forelse ($resultado->productos as $key => $producto)
                        <div>
                            <div class="shadow p-4">
                                <span>Descripción del producto</span>
                                <p class="h3">{{ $producto->descripcion}}</p>
                                <div>
                                    @can ('soy-autor', $proyecto)
                                        @if (!$producto->hasAnyActividad('C01', $producto->id))
                                            <a href="{{ route('actividades.create', [$proyecto->id, $producto->id, 1]) }}" class="btn-accion btn-accion-success mt-2 d-inline-block"><i class="fas fa-plus-circle"></i> Asociar una actividad a este producto</a>
                                        @elseif (!$producto->hasAnyActividad('C02', $producto->id))
                                            <a href="{{ route('actividades.create', [$proyecto->id, $producto->id, 2]) }}" class="btn-accion btn-accion-success mt-2 d-inline-block"><i class="fas fa-plus-circle"></i> Asociar una actividad a este producto</a>
                                        @elseif (!$producto->hasAnyActividad('C03', $producto->id))
                                            <a href="{{ route('actividades.create', [$proyecto->id, $producto->id, 3]) }}" class="btn-accion btn-accion-success mt-2 d-inline-block"><i class="fas fa-plus-circle"></i> Asociar una actividad a este producto</a>
                                        @elseif (!$producto->hasAnyActividad('C04', $producto->id))
                                            <a href="{{ route('actividades.create', [$proyecto->id, $producto->id, 4]) }}" class="btn-accion btn-accion-success mt-2 d-inline-block"><i class="fas fa-plus-circle"></i> Asociar una actividad a este producto</a>
                                        @endif
                                    @endcan
                                </div>
                                <div class="mt-5">
                                    <span class="lista-actividades">Lista de actividades</span>
                                    @forelse ($producto->actividades as $key => $actividad)
                                        <div class="datos-planeacion p-4">
                                            @if ($actividad->evaluacion)
                                                @if ($actividad->evaluacion->recomendacion)
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            @if ($proyecto->evaluacionExistente($proyecto, 'actividad_id', $actividad))
                                                                <div class="alert alert-danger" role="alert">
                                                                    <i class="fas fa-exclamation mr-1"></i><strong>Esta actividad tiene la siguiente recomendación:</strong> {{ $actividad->evaluacion->recomendacion }}
                                                                    <p><strong>Última fecha de evaluación: </strong><span class="fecha">{{ $actividad->evaluacion->updated_at }}</span></p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <p><strong>Descripción</strong></p>
                                                </div>
                                                <div class="col-md-7">
                                                    <p>{{ $actividad->descripcion }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <p><strong>Fecha de inicio</strong></p>
                                                </div>
                                                <div class="col-md-7">
                                                    <p class="fecha">{{ $actividad->fechaInicio }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <p><strong>Fecha de fin</strong></p>
                                                </div>
                                                <div class="col-md-7">
                                                    <p class="fecha">{{ $actividad->fechaFin }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <p><strong>Duración</strong></p>
                                                </div>
                                                <div class="col-md-7">
                                                    <p>{{ $actividad->duracion }} día(s)</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <p><strong>Última modificación</strong></p>
                                                </div>
                                                <div class="col-md-7">
                                                    <p class="fecha">{{ $actividad->updated_at }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <p><strong>Acciones</strong></p>
                                                </div>
                                                <div class="col-md-7">
                                                    @can ('soy-autor', $proyecto)
                                                        <a href="{{ route('actividades.edit', [$proyecto->id, $actividad->id]) }}" class="d-inline-block btn-accion btn-accion-primary"><i class="fas fa-pencil-alt"></i> Editar</a>
                                                        <form action="{{ route('actividades.destroy', [$proyecto->id, $actividad->id])}}" method="POST" class="d-inline-block form-destroy btn-delete" data-tipo="actividad" data-mensaje="Confirma si quieres eliminar esta actividad">
                                                            @csrf
                                                            @method("delete")

                                                            <button type="submit" class="btn btn-accion btn-accion-danger btn-delete"><i class="fas fa-times"></i> Eliminar</button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div>
                                            <p class="p-4">
                                                No hay actividades asociadas a a este producto
                                            </p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="shadow p-4">
                            <p>No se ha generado el producto correspondiente para poder asociar una actividad</p>
                        </div>
                    @endforelse
                @empty
                    <p class="p-5">No se ha generado el resultado correspondiente</p>
                @endforelse
            </div>
        </div>
    </div>
    @include('partials.modal')
    @component('partials.tutorial')
    @endcomponent
@endsection
