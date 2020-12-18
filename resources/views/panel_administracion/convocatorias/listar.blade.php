@extends('layouts.app')

@section('content')
    <div class="container">

        <h4 class="mt-5">Convocatorias de formulación de proyectos SENNOVA</h4>

        <hr>

        @include('partials.messages')
        @can('crear-convocatoria')
            <a class="btn btn-primary mb-5" href="{{ route('convocatorias.create') }}">Abrir convocatoria</a>
        @endcan
        <table class="table table-custom dataTable" data-page-length="50">
            <thead>
                <tr>
                    <th>Tipo de convocatoria</th>
                    <th>Descripción</th>
                    <th>Fecha inicio</th>
                    <th>Fecha fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($convocatorias as $convocatoria)
                    <tr>
                        <td>
                            @if ($convocatoria->convocatoriaCorreccion == true)
                                Convocatoria de corrección
                            @elseif ($convocatoria->convocatoriaCorreccion == false)
                                Convocatoria de formulación
                            @endif
                        </td>
                        <td>{{ $convocatoria->descripcion }}</td>
                        <td class="fecha">{{ $convocatoria->fecha_inicio }}</td>
                        <td class="fecha">{{ $convocatoria->fecha_fin }}</td>
                        <td>
                            <div class="dropdown acciones">
                                <button class="btn btn-transparent btn-sm dropdown-toggle" type="button" id="acciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu" aria-labelledby="acciones">
                                    @can ('editar-convocatoria')
                                        <a href="{{ route('convocatorias.edit', $convocatoria->id) }}" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Editar convocatoria</a>
                                    @endcan

                                    @can ('eliminar-convocatoria')
                                        <div class="dropdown-submenu dropdown-item p-0">
                                            <button class="btn btn-transparent p-0" type="button"><i class="fas fa-times"></i> Eliminar</button>
                                            <ul class="dropdown-menu p-0 position-relative">
                                                <li class="dropdown-item p-0">
                                                    <form action="{{ route('convocatorias.destroy', $convocatoria->id)}}" method="POST" class="d-block form-destroy">
                                                        @method('delete')
                                                        @csrf

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
                        <td>No hay convocatorias registradas</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
