@extends('layouts.app')

@section('body_class', 'panel-planeacion')

@section('content')
    @push('planeacion')
        @component('partials.menu-planeacion', ['proyecto' => $proyecto, 'idObjetivoEspecifico' => $proyecto->objetivosEspecificos->first()->id])

        @endcomponent

    @endpush

    @include('partials.messages')

    <div class="tab-content" id="pills-tabContent">

        <div class="nav flex-column nav-pills panel-izq" id="v-pills-tab-2" role="tablist" aria-orientation="vertical">
            @foreach ($proyecto->objetivosEspecificos as $key => $listaObjetivoEspecifico)
                <a class="nav-link {{ Request::is("panel/ver_planeacion/{$proyecto->id}/productos/{$listaObjetivoEspecifico->id}") ? 'active' : '' }}" href="{{ route('productos.show', [$proyecto->id, $listaObjetivoEspecifico->id]) }}">Resultado {{ $key + 1 }}:  Productos asociados </a>
            @endforeach

            <div class="mt-5">
                <button id="cd-tour-trigger" class="btn btn-transparent d-block mx-auto"><i class="fas fa-question-circle fa-2x text-primary"></i></button>
            </div>
        </div>

        <div class="tab-content panel-principal">
            @forelse ($objetivoEspecifico->resultados as $key => $resultado)
                <div class="descripcion-resultado">
                    <span>Descripción del resultado</span>
                    <p class="h3">
                        {{ $resultado->descripcion }}
                    </p>
                </div>
                <div>
                    @can ('soy-autor', $proyecto)
                        <div class="shadow p-4">
                            @if (!$resultado->hasAnyProducto('P01', $resultado->id))
                                <a href="{{ route('productos.create', [$proyecto->id, $resultado->id, 1]) }}" class="btn-accion btn-accion-success mt-2 d-inline-block"><i class="fas fa-plus-circle"></i> Asociar producto a este resultado</a>
                            @elseif (!$resultado->hasAnyProducto('P02', $resultado->id))
                                <a href="{{ route('productos.create', [$proyecto->id, $resultado->id, 2]) }}" class="btn-accion btn-accion-success mt-2 d-inline-block"><i class="fas fa-plus-circle"></i> Asociar producto a este resultado</a>
                            @elseif (!$resultado->hasAnyProducto('P03', $resultado->id))
                                <a href="{{ route('productos.create', [$proyecto->id, $resultado->id, 3]) }}" class="btn-accion btn-accion-success mt-2 d-inline-block"><i class="fas fa-plus-circle"></i> Asociar producto a este resultado</a>
                            @elseif (!$resultado->hasAnyProducto('P04', $resultado->id))
                                <a href="{{ route('productos.create', [$proyecto->id, $resultado->id, 4]) }}" class="btn-accion btn-accion-success mt-2 d-inline-block"><i class="fas fa-plus-circle"></i> Asociar producto a este resultado</a>
                            @endif
                        </div>
                    @endcan
                </div>

                @forelse ($resultado->productos as $producto)
                    <div class="datos-planeacion shadow p-4">
                        @if ($producto->evaluacion)
                            @if ($producto->evaluacion->recomendacion)
                                <div class="row">
                                    <div class="col-md-10">
                                        @if ($proyecto->evaluacionExistente($proyecto, 'producto_id', $producto))
                                            <div class="alert alert-danger" role="alert">
                                                <i class="fas fa-exclamation mr-1"></i><strong>Este producto tiene la siguiente recomendación:</strong> {{ $producto->evaluacion->recomendacion }}
                                                <p><strong>Última fecha de evaluación: </strong><span class="fecha">{{ $producto->evaluacion->updated_at }}</span></p>
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
                                <p>{{ $producto->descripcion }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p><strong>Fecha de inicio</strong></p>
                            </div>
                            <div class="col-md-7">
                                <p class="fecha">{{ $producto->fechaInicio }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p><strong>Fecha de fin</strong></p>
                            </div>
                            <div class="col-md-7">
                                <p class="fecha">{{ $producto->fechaFin }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p><strong>Duración (meses)</strong></p>
                            </div>
                            <div class="col-md-7">
                                <p>{{ $producto->duracion }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p><strong>Última modificación</strong></p>
                            </div>
                            <div class="col-md-7">
                                <p class="fecha">{{ $producto->updated_at }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p><strong>Acciones</strong></p>
                            </div>
                            <div class="col-md-7">
                                @can ('soy-autor', $proyecto)
                                    <a href="{{ route('productos.edit', [$proyecto->id, $producto->id]) }}" class="d-inline-block btn-accion btn-accion-primary"><i class="fas fa-pencil-alt"></i> Editar</a>
                                    <form action="{{ route('productos.destroy', [$proyecto->id, $producto->id])}}" method="POST" class="d-inline-block form-destroy btn-delete" data-tipo="producto" data-mensaje="Atención: Si eliminia este producto, también se eliminarán las actividades asociadas">
                                        @csrf
                                        @method("delete")

                                        <button type="submit" class="btn btn-accion btn-accion-danger btn-delete"><i class="fas fa-times"></i> Eliminar</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse

            @empty
                <p class="p-5">No se ha generado el resultado correspondiente</p>
            @endforelse
        </div>
    </div>

    @include('partials.modal')

    @component('partials.tutorial')
    @endcomponent
@endsection
