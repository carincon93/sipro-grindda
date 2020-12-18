@extends('layouts.app')

@section('content')
    <div class="container">

        <h4 class="mt-5">Logos de aliados</h4>

        <hr>

        @can ('crear-informacion')
            <a class="btn btn-primary mb-5" href="{{ route('logos_aliados.create') }}">Añadir logo de aliado</a>
        @endcan

        @include('partials.messages')

        <table class="table table-custom dataTable" data-page-length="50">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logosAliados as $logoAliado)
                    <tr>
                        <td>
                            <figure>
                                <img src="{{ Storage::url($logoAliado->logo) }}" alt="" class="img-fluid">
                            </figure>
                        </td>
                        <td>
                            <div class="dropdown acciones">
                                <button class="btn btn-transparent btn-sm dropdown-toggle" type="button" id="acciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu" aria-labelledby="acciones">
                                    <a href="{{ route('logos_aliados.edit', $logoAliado->id) }}" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Editar</a>

                                    <div class="dropdown-submenu dropdown-item">
                                        <button class="btn btn-transparent p-0" type="button"><i class="fas fa-times"></i> Eliminar</button>
                                        <ul class="dropdown-menu p-0">
                                            <li class="dropdown-item p-0">
                                                <form action="{{ route('logos_aliados.destroy', $logoAliado->id)}}" method="POST" class="d-block form-destroy">
                                                    @method('delete')
                                                    @csrf

                                                    <button type="submit" class="btn btn-danger">Confirmar</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>No hay logos de aliados registrados</td>
                        <td></td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

@endsection
