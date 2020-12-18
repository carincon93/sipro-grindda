@extends('layouts.app')

@section('content')
    <div class="container">

        <h4 class="mt-5">Semilleros / Proyectos</h4>

        <table class="table table-custom dataTable tabla-proyectos">
            <thead>
                <tr>
                    <th>Semillero</th>
                    <th>Proyectos formulados</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($semilleros as $key => $semillero)
                    <tr>
                        <td>{{ $semillero->nombre }}</td>
                        <td>{{ count($semillero->proyectos) }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{ route('semilleros.proyectos', $semillero->nombre) }}">Ver proyectos asociados</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Los semilleros no han formulado proyectos aún</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
