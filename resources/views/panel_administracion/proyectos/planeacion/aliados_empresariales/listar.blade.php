@extends('layouts.app')

@section('content')
    @push('planeacion')
        @component('partials.menu-planeacion', ['proyecto' => $proyecto, 'idObjetivoEspecifico' => $proyecto->objetivosEspecificos->first()->id])

        @endcomponent

    @endpush
    <div class="container">

        <h3>Aliados empresariales</h3>

        <hr>

        @can ('soy-autor', $proyecto)
            <a href="{{ route('aliados.create', $proyecto->id) }}" class="btn btn-primary mb-5">Añadir aliado empresarial</a>
        @endcan

        @include('partials.messages')

        <table class="table table-custom dataTable tabla-proyectos">
            <thead>
                <tr>
                    <th>Nombre aliado</th>
                    <th>Nombre contacto</th>
                    <th>Número celular</th>
                    <th>Correo electrónico</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($proyecto->aliados as $aliado)
                    <tr>
                        <td>
                            @if ($aliado->evaluacion)
                                @if ($aliado->evaluacion->recomendacion)
                                    <div><span class="badge badge-danger">Este aliado empresarial ha sido evaluado! <a href="{{ route('aliados.show', [$proyecto->id, $aliado->id]) }}" class="text-light"><u>Mira si tiene recomendaciones</u></a></span></div>
                                @endif
                            @endif
                            {{ $aliado->nombreAliado }}
                        </td>
                        <td>{{ $aliado->nombre }}</td>
                        <td>{{ $aliado->celular }}</td>
                        <td>{{ $aliado->email }}</td>
                        <td>
                            <div class="dropdown acciones">
                                <button class="btn btn-transparent btn-sm dropdown-toggle" type="button" id="acciones-presupuesto-sennova" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu" aria-labelledby="acciones-presupuesto-sennova">
                                    <a href="{{ route('aliados.descargarCartaConvenio', [$aliado->id]) }}" class="dropdown-item"><i class="far fa-arrow-alt-circle-down"></i> Descargar carta del convenio</a>

                                    <a href="{{ route('aliados.show', [$proyecto->id, $aliado->id]) }}" class="dropdown-item"><i class="fas fa-eye"></i> Ver aliado empresarial</a>

                                    @can ('soy-autor', $proyecto)
                                        <a href="{{ route('presupuestos_empresariales.createPresupuestoEmpresarial', [$proyecto->id, $aliado->id]) }}" class="dropdown-item"><i class="fas fa-dollar-sign"></i> Generar presupuesto</a>
                                        <a href="{{ route('aliados.edit', [$proyecto->id, $aliado->id]) }}" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Editar aliado empresarial</a>
                                        <div class="dropdown-submenu dropdown-item p-0">
                                            <button class="btn btn-transparent p-0" type="button"><i class="fas fa-times"></i> Eliminar</button>
                                            <ul class="dropdown-menu p-0 position-relative">
                                                <li class="dropdown-item p-0">
                                                    <form action="{{ route("aliados.destroy", [$proyecto->id, $aliado->id])}}" method="POST" class="d-block form-destroy">
                                                        @csrf
                                                        @method("delete")

                                                        <button type="submit" class="btn btn-danger">Confirmar</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    @endcan
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No hay alianzas empresariales registradas</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
