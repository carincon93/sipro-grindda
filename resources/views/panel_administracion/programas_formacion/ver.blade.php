@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-5">{{ $programaFormacion->nombre }}</h1>

        <p><strong>Nivel académico: </strong>{{ $programaFormacion->nivelAcademico }}</p>
        <p><strong>Sector productivo: </strong>{{ $programaFormacion->sectorProductivo }}</p>

        <hr>

        <table class="table table-custom dataTable" data-page-length="50">
            <thead>
                <tr>
                    <th>Aprendices asociados</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($programaFormacion->aprendices as $aprendiz)
                    <tr>
                        <td>
                            <ul>
                                <li class="text-capitalize">{{ $aprendiz->nombre }}</li>
                                @forelse ($aprendiz->proyectos as $proyecto)
                                    <li>
                                        <div>
                                            <strong>Proyectos asociados:</strong>
                                            {{ $proyecto->titulo }}
                                            <a href="{{ route('proyectos.show', $proyecto->id) }}">Ver</a>
                                        </div>
                                    </li>
                                @empty
                                    <li class="text-muted">El aprendiz no tiene proyectos asociados</li>
                                @endforelse
                            </ul>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>El programa de formación no tiene aprendices asociados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
