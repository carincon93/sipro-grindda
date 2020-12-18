@extends('layouts.app')

@section('content')
    <div class="container">

        <h4 class="mt-5">Usuarios</h4>

        <hr>

        @can ('crear-usuario')
            <a class="btn btn-primary mb-5" href="{{ route('usuarios.create') }}">Añadir usuario</a>
        @endcan

        <a class="btn btn-success background-success text-light mb-5" href="{{ route('usuarios.descargarExcelUsuarios', $tipoRol) }}"><i class="fas fa-file-excel"></i> Exportar a excel</a>

        @include('partials.messages')

        <table class="table table-custom dataTable" data-page-length="50">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Dirección de correo electrónico</th>
                    <th>Roles</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($usuarios as $usuario)
                    <tr>
                        <td class="text-capitalize">{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>
                            <ul>
                                @forelse ($usuario->roles as $rol)
                                    <li>{{ $rol->nombre }}</li>
                                @empty
                                    <li>
                                        El usuario no tiene un rol asignado.
                                    </li>
                                @endforelse
                            </ul>
                        </td>
                        <td>
                            <div class="dropdown acciones">
                                <button class="btn btn-transparent btn-sm dropdown-toggle" type="button" id="acciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu" aria-labelledby="acciones">
                                    @can ('ver-usuario')
                                        <a href="{{route('usuarios.show', $usuario->id)}}" class="dropdown-item"><i class="fas fa-eye"></i> Consultar</a>
                                    @endcan
                                    @can ('editar-usuario')
                                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Editar</a>
                                    @endcan
                                    @can ('eliminar-usuario')
                                        <div class="dropdown-submenu dropdown-item p-0">
                                            <button class="btn btn-transparent p-0" type="button"><i class="fas fa-times"></i> Eliminar</button>
                                            <ul class="dropdown-menu p-0 position-relative">
                                                <li class="dropdown-item p-0">
                                                    <form action="{{ route('usuarios.destroy', $usuario->id)}}" method="POST" class="d-block form-destroy">
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
                    <p>No hay usuarios registrados</p>
                @endforelse

            </tbody>
        </table>
    </div>
@endsection
