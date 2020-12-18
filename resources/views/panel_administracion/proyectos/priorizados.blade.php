@extends('layouts.app')

@section('content')
<div class="container">

    <h4 class="mt-5">Proyectos priorizados</h4>

    <hr>

    @include('partials.messages')

    <h5>Pertinencia: Alta</h5>
    <table class="table table-custom dataTable tabla-proyectos">
        <thead>
            <tr>
                <th>Código</th>
                <th>Título del proyecto</th>
                <th>Pertinencia</th>
                <th style="width: 10%">Evaluacion de criterios (%)</th>
                <th style="width: 10%">Viabilidad</th>
                <th class="fecha-creacion">Fecha de creación</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($proyectosPriorizados as $key => $proyecto)
                @if ($proyecto->nivelPertinencia == 3)
                    <tr>
                        <td>{{ $proyecto->codigo }}</td>
                        <td style="width: 404px;">{{ $proyecto->titulo }}</td>
                        <td class="text-capitalize">
                            @if ($proyecto->nivelPertinencia == 3)
                                Alta
                            @elseif ($proyecto->nivelPertinencia == 2)
                                Media
                            @elseif ($proyecto->nivelPertinencia == 1)
                                Baja
                            @endif
                        </td>
                        <td class="text-capitalize">{{ $proyecto->sumaPorcentajeCriterios() }} %</td>
                        <td>{{ number_format($proyecto->estado, 2, '.', ',').' %' }}</td>
                        <td>@include('partials.dropdown-acciones')</td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="4">No hay proyectos evaluados</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <hr>
    <h5>Pertinencia: Media</h5>
    <table class="table table-custom dataTable tabla-proyectos">
        <thead>
            <tr>
                <th>Código</th>
                <th>Título del proyecto</th>
                <th>Pertinencia</th>
                <th style="width: 10%">Evaluacion de criterios (%)</th>
                <th style="width: 10%">Viabilidad</th>
                <th class="fecha-creacion">Fecha de creación</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($proyectosPriorizados as $key => $proyecto)
                @if ($proyecto->nivelPertinencia == 2)
                    <tr>
                        <td>{{ $proyecto->codigo }}</td>
                        <td style="width: 404px;">{{ $proyecto->titulo }}</td>
                        <td class="text-capitalize">
                            @if ($proyecto->nivelPertinencia == 3)
                                Alta
                            @elseif ($proyecto->nivelPertinencia == 2)
                                Media
                            @elseif ($proyecto->nivelPertinencia == 1)
                                Baja
                            @endif
                        </td>
                        <td class="text-capitalize">{{ $proyecto->sumaPorcentajeCriterios() }} %</td>
                        <td>{{ number_format($proyecto->estado, 2, '.', ',').' %' }}</td>
                        <td>@include('partials.dropdown-acciones')</td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="4">No hay proyectos evaluados</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h5>Pertinencia: Baja</h5>
    <table class="table table-custom dataTable tabla-proyectos">
        <thead>
            <tr>
                <th>Código</th>
                <th>Título del proyecto</th>
                <th>Pertinencia</th>
                <th style="width: 10%">Evaluacion de criterios (%)</th>
                <th style="width: 10%">Viabilidad</th>
                <th class="fecha-creacion">Fecha de creación</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($proyectosPriorizados as $key => $proyecto)
                @if ($proyecto->nivelPertinencia == 1)
                    <tr>
                        <td>{{ $proyecto->codigo }}</td>
                        <td style="width: 404px;">{{ $proyecto->titulo }}</td>
                        <td class="text-capitalize">
                            @if ($proyecto->nivelPertinencia == 3)
                                Alta
                            @elseif ($proyecto->nivelPertinencia == 2)
                                Media
                            @elseif ($proyecto->nivelPertinencia == 1)
                                Baja
                            @endif
                        </td>
                        <td class="text-capitalize">{{ $proyecto->sumaPorcentajeCriterios() }} %</td>
                        <td>{{ number_format($proyecto->estado, 2, '.', ',').' %' }}</td>
                        <td>@include('partials.dropdown-acciones')</td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="4">No hay proyectos evaluados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
