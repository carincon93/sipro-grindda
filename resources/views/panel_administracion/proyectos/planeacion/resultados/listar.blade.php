@extends('layouts.app')

@section('body_class', 'panel-planeacion')

@section('content')
    @push('planeacion')
        @component('partials.menu-planeacion', ['proyecto' => $proyecto, 'idObjetivoEspecifico' => $proyecto->objetivosEspecificos->first()->id])

        @endcomponent

    @endpush

    @include('partials.messages')

    <div class="tab-content" id="pills-tabContent">
        <div class="nav flex-column nav-pills panel-izq" id="v-pills-tab" role="tablist" aria-orientation="vertical">

            @foreach ($proyecto->objetivosEspecificos as $key => $listaObjetivoEspecifico)
                <a class="nav-link {{ Request::is("panel/ver_planeacion/{$proyecto->id}/resultados/{$listaObjetivoEspecifico->id}") ? 'active' : '' }}" href="{{ route('resultados.show', [$proyecto->id, $listaObjetivoEspecifico->id]) }}">Objetivo específico {{ $key + 1 }}</a>
            @endforeach

            <div class="mt-5">
                <button id="cd-tour-trigger" class="btn btn-transparent d-block mx-auto"><i class="fas fa-question-circle fa-2x text-primary"></i></button>
            </div>
        </div>

        <div class="tab-content panel-principal">

            <div>
                <div class="descripcion-objetivo-especifico">
                    <span>Descripción del objetivo especifico</span>
                    <p class="h3">
                        {{ $objetivoEspecifico->descripcion }}
                    </p>
                    @can ('soy-autor', $proyecto)
                        @if ($proyecto->objetivosEspecificos->count() > 3)
                            <form action="{{ route('proyectos.eliminarObjetivoEspecifico', $objetivoEspecifico->id) }}" method="POST" class="d-inline-block form-destroy btn-delete" data-tipo="objetivo específico" data-mensaje="Atención: Si elimina este objetivo específico, también se eliminarán los resultados, productos y actividades asociados">
                                @csrf
                                @method("delete")

                                <button type="submit" class="btn btn-accion btn-accion-danger btn-delete"><i class="fas fa-times"></i> Eliminar</button>
                            </form>
                        @endif
                    @endcan
                </div>
                <div class="datos-planeacion shadow mb-5 p-4">
                    @forelse ($objetivoEspecifico->resultados as $key => $resultado)
                        @if ($resultado->evaluacion)
                            @if ($resultado->evaluacion->recomendacion)
                                <div class="row">
                                    <div class="col-md-10">
                                        @if ($proyecto->evaluacionExistente($proyecto, 'resultado_id', $resultado))
                                            <div class="alert alert-danger" role="alert">
                                                <i class="fas fa-exclamation mr-1"></i><strong>Este resultado tiene la siguiente recomendación: </strong>{{ $resultado->evaluacion->recomendacion }}
                                                <p><strong>Última fecha de evaluación: </strong><span class="fecha">{{ $resultado->evaluacion->updated_at }}</span></p>
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
                                <p>{{ $resultado->descripcion }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p><strong>Indicador</strong></p>
                            </div>
                            <div class="col-md-7">
                                <p>{{ $resultado->indicador }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p><strong>Medio de verificación</strong></p>
                            </div>
                            <div class="col-md-7">
                                <p>{{ $resultado->medioVerificacion }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p><strong>Meta</strong></p>
                            </div>
                            <div class="col-md-7">
                                <p>{{ $resultado->meta }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p><strong>Última modificación</strong></p>
                            </div>
                            <div class="col-md-7">
                                <p class="fecha">{{ $resultado->updated_at }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p><strong>Acciones</strong></p>
                            </div>
                            <div class="col-md-7">
                                @can ('soy-autor', $proyecto)
                                    <a href="{{ route('resultados.edit', [$proyecto->id, $resultado->id]) }}" class="d-inline-block btn-accion btn-accion-primary"><i class="fas fa-pencil-alt"></i> Editar</a>
                                    <form action="{{ route('resultados.destroy', [$proyecto->id, $resultado->id]) }}" method="POST" class="d-inline-block form-destroy btn-delete" data-tipo="resultado" data-mensaje="Atención: Si elimina este resultado, también se eliminarán los productos y actividades asociados">
                                        @csrf
                                        @method("delete")

                                        <button type="submit" class="btn btn-accion btn-accion-danger btn-delete"><i class="fas fa-times"></i> Eliminar</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    @empty
                        @can ('soy-autor', $proyecto)
                            <a href="{{ route('resultados.create', [$proyecto->id, $objetivoEspecifico->id]) }}" class="btn-accion btn-accion-success mt-2 d-inline-block"><i class="fas fa-plus-circle"></i> Asociar resultado a este objetivo específico</a>
                        @endcan
                    @endforelse
            </div>
        </div>
    </div>
</div>
@include('partials.modal')
@component('partials.tutorial')
@endcomponent
@endsection
