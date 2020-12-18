@extends('layouts.app')
@section('content')
    <div class="container">

        <h4 class="mt-5">Programas de formación</h4>

        <hr>

        @can ('crear-programa-formacion')
            <a class="btn btn-primary mb-5" href="{{ route('programas_formacion.create') }}">Añadir programa de formación</a>
        @endcan

        @include('partials.messages')

        <table class="table table-custom dataTable" data-page-length="50">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad de aprendices asociados</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($programasFormacion as $programaFormacion)
                    <tr>
                        <td>{{ $programaFormacion->nombre }}</td>
                        <td>
                            {{ $programaFormacion->aprendices->count() }}
                        </td>
                        <td>
                            <div class="dropdown acciones">
                                <button class="btn btn-transparent btn-sm dropdown-toggle" type="button" id="acciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu" aria-labelledby="acciones">
                                    @can ('ver-programa-formacion')
                                        <a href="{{ route('programas_formacion.show', $programaFormacion->id) }}" class="dropdown-item"><i class="fas fa-eye"></i> Consultar</a>
                                    @endcan
                                    @can ('editar-programa-formacion')
                                        <a href="{{ route('programas_formacion.edit', $programaFormacion->id) }}" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Editar</a>
                                    @endcan
                                    @can ('eliminar-programa-formacion')
                                        <div class="dropdown-submenu dropdown-item p-0">
                                            <button class="btn btn-transparent p-0" type="button"><i class="fas fa-times"></i> Eliminar</button>
                                            <ul class="dropdown-menu p-0 position-relative">
                                                <li class="dropdown-item p-0">
                                                    <form action="{{ route('programas_formacion.destroy', $programaFormacion->id)}}" method="POST" class="d-block form-destroy">
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
                    <p>No hay programas de formación registrados</p>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
