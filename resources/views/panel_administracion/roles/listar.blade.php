@extends('layouts.app')

@section('content')
    <div class="container">

        <h4 class="mt-5">Roles</h4>

        <hr>

        @can ('crear-rol')
            <a class="btn btn-primary mb-5" href="{{ route('roles.create') }}">Añadir rol</a>
        @endcan

        @include('partials.messages')

        <table class="table table-custom dataTable" data-page-length="50">
            <thead>
                <tr>
                    <th>Nombre del rol</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $rol)
                    <tr>
                        <td>{{ $rol->nombre }}</td>
                        <td>{{ $rol->descripcion }}</td>
                        <td>
                            <div class="dropdown acciones">
                                <button class="btn btn-transparent btn-sm dropdown-toggle" type="button" id="acciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu" aria-labelledby="acciones">
                                    @can ('ver-rol')
                                        <a href="{{ route('roles.show', $rol->id) }}" class="dropdown-item"><i class="fas fa-eye"></i> Consultar</a>
                                    @endcan
                                    @can ('editar-rol')
                                        <a href="{{ route('roles.edit', $rol->id) }}" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Editar</a>
                                    @endcan
                                    @can ('eliminar-rol')
                                        <div class="dropdown-submenu dropdown-item p-0">
                                            <button class="btn btn-transparent p-0" type="button"><i class="fas fa-times"></i> Eliminar</button>
                                            <ul class="dropdown-menu p-0 position-relative">
                                                <li class="dropdown-item p-0">
                                                    <form action="{{ route('roles.destroy', $rol->id)}}" method="POST" class="d-block form-destroy">
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
                        <td colspan="3">No hay roles registrados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
