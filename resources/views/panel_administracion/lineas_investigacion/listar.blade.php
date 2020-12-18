@extends('layouts.app')
@section('content')
    <div class="container">

        <h4 class="mt-5">Líneas de investigación</h4>

        <hr>

        @can ('crear-linea-investigacion')
            <a class="btn btn-primary mb-5" href="{{ route('lineas_investigacion.create') }}">Añadir línea de investigación</a>
        @endcan

        @include('partials.messages')

        <table class="table table-custom dataTable" data-page-length="50">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lineaInvestigacion as $linea)
                    <tr>
                        <td>{{ $linea->nombre }}</td>
                        <td>{{ $linea->descripcion }}</td>
                        <td>
                            <div class="dropdown acciones">
                                <button class="btn btn-transparent btn-sm dropdown-toggle" type="button" id="acciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu" aria-labelledby="acciones">
                                    @can ('editar-linea-investigacion')
                                        <a href="{{ route('lineas_investigacion.edit', $linea->id) }}" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Editar</a>
                                    @endcan
                                    {{-- @can ('eliminar-linea-investigacion')
                                        <div class="dropdown-submenu dropdown-item p-0">
                                            <button class="btn btn-transparent p-0" type="button"><i class="fas fa-times"></i> Eliminar</button>
                                            <ul class="dropdown-menu p-0 position-relative">
                                                <li class="dropdown-item p-0">
                                                    <form action="{{ route('lineas_investigacion.destroy', $linea->id)}}" method="POST" class="d-block form-destroy">
                                                        @method('delete')
                                                        @csrf

                                                        <button type="submit" class="btn btn-danger">Confirmar</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    @endcan --}}
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>No hay líneas de investigación registradas</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
