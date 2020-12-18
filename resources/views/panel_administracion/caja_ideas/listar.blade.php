@extends('layouts.app')

@section('content')
    <div class="container">

        <h4 class="mt-5">Caja de ideas</h4>

        <hr>

        @include('partials.messages')

        <table class="table table-custom dataTable" data-page-length="50">
            <thead>
                <tr>
                    <th>Nombre de la empresa</th>
                    <th>NIT</th>
                    <th>Idea</th>
                    <th>Presupuesto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cajaIdeas as $idea)
                    <tr>
                        <td style="width: 150px">{{ $idea->nombreEmpresa }}</td>
                        <td style="width: 150px">{{ $idea->nit }}</td>
                        <td>{{ $idea->idea }}</td>
                        <td style="width: 200px"><strong>$ {{number_format($idea->presupuesto, 0, ',', '.')}}</strong></td>
                        <td>
                            <div class="dropdown acciones">
                                <button class="btn btn-transparent btn-sm dropdown-toggle" type="button" id="acciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu" aria-labelledby="acciones">
                                    @can ('ver-caja-ideas')
                                        <a href="{{ route('caja_ideas.show', $idea->id) }}" class="dropdown-item"><i class="fas fa-eye"></i> Consultar</a>
                                    @endcan

                                    @can ('editar-caja-ideas')
                                        <a href="{{ route('caja_ideas.edit', $idea->id) }}" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Editar</a>
                                    @endcan
                                    @can ('eliminar-caja-ideas')
                                        <div class="dropdown-submenu dropdown-item p-0">
                                            <button class="btn btn-transparent p-0" type="button"><i class="fas fa-times"></i> Eliminar</button>
                                            <ul class="dropdown-menu p-0 position-relative">
                                                <li class="dropdown-item p-0">
                                                    <form action="{{ route('caja_ideas.destroy', $idea->id)}}" method="POST" class="d-block form-destroy">
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
                        <td>No hay ideas registradas</td>
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
