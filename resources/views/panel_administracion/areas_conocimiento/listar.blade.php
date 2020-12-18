@extends('layouts.app')

@section('content')
    <div class="container">

        <h4 class="mt-5">Áreas de conocimiento</h4>

        <hr>

        @can ('crear-informacion')
            <a class="btn btn-primary mb-5" href="{{ route('areas_conocimiento.create') }}">Añadir área de conocimiento</a>
        @endcan

        @include('partials.messages')

        <table class="table table-custom dataTable" data-page-length="50">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($areas as $area)
                    <tr>
                        <td>{{ $area->codigo }}</td>
                        <td>{{ $area->nombre }}</td>
                        <td>
                            <div class="dropdown acciones">
                                <button class="btn btn-transparent btn-sm dropdown-toggle" type="button" id="acciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu" aria-labelledby="acciones">

                                    @can ('editar-informacion')
                                        <a href="{{ route('areas_conocimiento.edit', $area->id) }}" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Editar</a>
                                    @endcan
                                    @can ('eliminar-informacion')
                                        <div class="dropdown-submenu dropdown-item p-0">
                                            <button class="btn btn-transparent p-0" type="button"><i class="fas fa-times"></i> Eliminar</button>
                                            <ul class="dropdown-menu p-0 position-relative">
                                                <li class="dropdown-item p-0">
                                                    <form action="{{ route('areas_conocimiento.destroy', $area->id)}}" method="POST" class="d-block form-destroy">
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
                    <p>No hay áreas de conocimiento registradas</p>
                @endforelse
            </tbody>
        </table>



    </div>
@endsection
