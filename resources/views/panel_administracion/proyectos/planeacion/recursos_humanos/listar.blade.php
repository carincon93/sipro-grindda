@extends('layouts.app')

@section('content')
    @push('planeacion')
        @component('partials.menu-planeacion', ['proyecto' => $proyecto, 'idObjetivoEspecifico' => $proyecto->objetivosEspecificos->first()->id])

        @endcomponent

    @endpush

    <div class="container">

        <h3>Personal</h3>

        <hr>

        @can ('soy-autor', $proyecto)
            <a href="{{ route('recursos_humanos.create', $proyecto->id) }}" class="btn btn-primary mb-5">Añadir personal interno / instructor</a>
        @endcan

        @include('partials.messages')

        <table class="table table-custom dataTable tabla-proyectos">
            <thead>
                <tr>
                    <th>Nombre del personal</th>
                    <th>Número de documento del personal</th>
                    <th>Tipo de personal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($proyecto->recursosHumanos as $recursoHumano)
                    <tr>
                        <td>
                            @if ($recursoHumano->evaluacion)
                                @if ($recursoHumano->evaluacion->recomendacion)
                                    <div><span class="badge badge-danger">Este recurso humano ha sido evaluado! <a href="{{ route('recursos_humanos.show', [$proyecto->id, $recursoHumano->id]) }}" class="text-light"><u>Mira si tiene recomendaciones</u></a></span></div>
                                @endif
                            @endif
                            {{ $recursoHumano->nombrePersonal }}
                        </td>
                        <td>{{ $recursoHumano->numeroDocumentoPersonal }}</td>
                        <td>
                            @if ( $recursoHumano->personalInterno == true )
                                Personal interno
                            @elseif ($recursoHumano->personalInstructor == true)
                                Personal instructor
                            @endif
                        </td>
                        <td>
                            <div class="dropdown acciones">
                                <button class="btn btn-transparent btn-sm dropdown-toggle" type="button" id="acciones-presupuesto-sennova" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu" aria-labelledby="acciones-presupuesto-sennova">
                                    @if ($recursoHumano->personalInstructor == true)
                                        <a href="{{ route('recursos_humanos.descargarCartaCompromiso', $recursoHumano->id) }}" class="dropdown-item"><i class="far fa-arrow-alt-circle-down"></i> Descargar carta de compromiso</a>
                                    @endif

                                    <a href="{{ route('recursos_humanos.show', [$proyecto->id, $recursoHumano->id]) }}" class="dropdown-item"><i class="fas fa-eye"></i> Ver personal</a>

                                    @can ('soy-autor', $proyecto)
                                        <a href="{{ route('recursos_humanos.edit', [$proyecto->id, $recursoHumano->id]) }}" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Editar personal</a>
                                        <div class="dropdown-submenu dropdown-item p-0">
                                            <button class="btn btn-transparent p-0" type="button"><i class="fas fa-times"></i> Eliminar</button>
                                            <ul class="dropdown-menu p-0 position-relative">
                                                <li class="dropdown-item p-0">
                                                    <form action="{{ route("recursos_humanos.destroy", [$proyecto->id, $recursoHumano->id])}}" method="POST" class="d-block form-destroy">
                                                        @csrf
                                                        @method("delete")

                                                        <input type="hidden" name="idProyecto" value="{{ $proyecto->id }}">
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
                        <td colspan="4">No hay personal registrado</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
