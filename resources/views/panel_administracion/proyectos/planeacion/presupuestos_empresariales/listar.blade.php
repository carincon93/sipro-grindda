@extends('layouts.app')

@section('content')
    @push('planeacion')
        @component('partials.menu-planeacion', ['proyecto' => $proyecto, 'idObjetivoEspecifico' => $proyecto->objetivosEspecificos->first()->id])

        @endcomponent

    @endpush

    <div class="container">

        <h3>Presupuestos empresariales</h3>

        <hr>

        @include('partials.messages')

        @forelse ($proyecto->aliados as $aliado)

            <h3>{{ $aliado->nombreAliado }}</h3>

            @can ('soy-autor', $proyecto)
                <a href="{{ route('presupuestos_empresariales.createPresupuestoEmpresarial', [$proyecto->id, $aliado->id]) }}" class="btn btn-primary btn btn-primary mb-5">Generar presupuesto para este aliado empresarial</a>
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
                    @forelse ($aliado->presupuestosEmpresariales as $presupuestoEmpresarial)
                        <tr>
                            <td>
                                @if ($presupuestoEmpresarial->evaluacion)
                                    @if ($presupuestoEmpresarial->evaluacion->recomendacion)
                                        <div><span class="badge badge-danger">Este rubro ha sido evaluado! <a href="{{ route('presupuestos_empresariales.show', [$proyecto->id, $presupuestoEmpresarial->id]) }}" class="text-light"><u>Mira si tiene recomendaciones</u></a></span></div>
                                    @endif
                                @endif
                                {{ $presupuestoEmpresarial->nombreItem }}
                            </td>
                            <td><strong>$ {{ number_format($presupuestoEmpresarial->valor, 0, ',', '.') }}</strong></td>
                            <td>{{ $presupuestoEmpresarial->descripcion }}</td>
                            <td>
                                <div class="dropdown acciones">
                                    <button class="btn btn-transparent btn-sm dropdown-toggle" type="button" id="acciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Acciones
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="acciones">
                                        @if ($presupuestoEmpresarial->archivo !== null)
                                            <a href="{{ route('presupuestos_empresariales.descargarCartaPresupuesto', $presupuestoEmpresarial->id) }}" class="dropdown-item"><i class="far fa-arrow-alt-circle-down"></i> Descargar anexo</a>
                                        @endif
                                        
                                        <a href="{{ route('presupuestos_empresariales.show', [$proyecto->id, $presupuestoEmpresarial->id]) }}" class="dropdown-item"><i class="fas fa-eye"></i> Ver presupuesto empresarial</a>

                                        @can ('soy-autor', $proyecto)
                                            <a href="{{ route('presupuestos_empresariales.edit', [$proyecto->id, $presupuestoEmpresarial->id]) }}" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Editar presupuesto empresarial</a>
                                            <li class="dropdown-submenu dropdown-item p-0">
                                                <button class="btn btn-transparent p-0" type="button"><i class="fas fa-times"></i> Eliminar</button>
                                                <ul class="dropdown-menu p-0 position-relative">
                                                    <li class="dropdown-item p-0">
                                                        <form action="{{ route('presupuestos_empresariales.destroy', [$proyecto->id, $presupuestoEmpresarial->id])}}" method="POST" class="d-block form-destroy">
                                                            @csrf
                                                            @method("delete")

                                                            <button type="submit" class="btn btn-danger">Confirmar</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </li>
                                        @endcan
                                    </div>
                                </div>
                            </td>
                        @empty
                            <td colspan="4">
                                No hay presupuestos empresariales registrados
                            </td>
                        @endforelse
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        @isset($presupuestoEmpresarial)
                            <td colspan="4"><strong>Total: </strong> $ {{ number_format($presupuestoEmpresarial->totalPresupuesto($aliado->id), 0, ',', '.') }}</td>
                        @endisset
                    </tr>
                </tfoot>
            </table>

            <hr>
        @empty
            <p>No hay aliados empresariales registrados</p>
        @endforelse
    </div>
@endsection
