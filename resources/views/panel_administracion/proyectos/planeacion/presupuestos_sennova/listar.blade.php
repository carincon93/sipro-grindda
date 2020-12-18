@extends('layouts.app')

@section('content')
    @push('planeacion')
        @component('partials.menu-planeacion', ['proyecto' => $proyecto, 'idObjetivoEspecifico' => $proyecto->objetivosEspecificos->first()->id])

        @endcomponent

    @endpush

    <div class="container">

        <h3>Presupuesto SENNOVA</h3>

        <hr>

        @include('partials.messages')

        @can ('soy-autor', $proyecto)
            <a class="btn btn-primary mb-5" href="{{ route('presupuestos_sennova.create', $proyecto->id) }}">Añadir presupuesto SENNOVA</a>
        @endcan

        <table class="table table-custom dataTable tabla-proyectos">
            <thead>
                <tr>
                    <th>Nombre del presupuesto</th>
                    <th>Valor del presupuesto</th>
                    <th style="width: 40%;">¿Para qué?</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($proyecto->presupuestos as $key => $presupuesto)
                    <tr>
                        <td>
                            @if ($presupuesto->evaluacion)
                                @if ($presupuesto->evaluacion->recomendacion)
                                    <div><span class="badge badge-danger">Este rubro ha sido evaluado! <a href="{{ route('presupuestos_sennova.show', [$proyecto->id, $presupuesto->id]) }}" class="text-light"><u>Mira si tiene recomendaciones</u></a></span></div>
                                @endif
                            @endif
                            {{ $presupuesto->nombreItem }}
                        </td>
                        <td><strong>$ {{ number_format($presupuesto->valor, 0, ',', '.') }}</strong></td>
                        <td>{{ $presupuesto->descripcion }}</td>
                        <td>
                            <div class="dropdown acciones">
                                <button class="btn btn-transparent btn-sm dropdown-toggle" type="button" id="acciones-presupuesto-sennova" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu" aria-labelledby="acciones-presupuesto-sennova">

                                    @if ($presupuesto->archivo !== null)
                                        <a href="{{ route('presupuestos_sennova.descargarCartaPresupuesto', $presupuesto->id) }}" class="dropdown-item"><i class="far fa-arrow-alt-circle-down"></i> Descargar anexo</a>
                                    @endif
                                    <a href="{{ route('presupuestos_sennova.show', [$proyecto->id, $presupuesto->id]) }}" class="dropdown-item"><i class="fas fa-eye"></i> Ver presupuesto</a>

                                    @can ('soy-autor', $proyecto)
                                        <a href="{{ route('presupuestos_sennova.edit', [$proyecto->id, $presupuesto->id]) }}" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Editar presupuesto</a>
                                        <div class="dropdown-submenu dropdown-item p-0">
                                            <button class="btn btn-transparent p-0" type="button"><i class="fas fa-times"></i> Eliminar</button>
                                            <ul class="dropdown-menu p-0 position-relative">
                                                <li class="dropdown-item p-0">
                                                    <form action="{{ route('presupuestos_sennova.destroy', [$proyecto->id, $presupuesto->id])}}" method="POST" class="d-block form-destroy">
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
                        <td colspan="4">No tienes presupuestos registrados aún</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    @isset($presupuesto)
                        <td colspan="4"><strong>Total: </strong> $ {{ number_format($presupuesto->totalPresupuesto($proyecto->id), 0, ',', '.') }}</td>
                    @endisset
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
