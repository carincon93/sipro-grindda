@extends('layouts.app')

@section('content')
    <div class="container">

        <h4 class="mt-5">Información del centro de formación</h4>

        <hr>

        @include('partials.messages')

        <table class="table table-custom dataTable" data-page-length="50">
            <thead>
                <tr>
                    <th>Nombre del centro de formación</th>
                    <th>Nombre del subdirector</th>
                    <th>Correo electrónico del subdirector</th>
                    <th>Número celular del subdirector</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($centroFormacion as $centro)
                    <tr>
                        <td>{{ $centro->nombreCentroFormacion }}</td>
                        <td>{{ $centro->nombreSubdirector }}</td>
                        <td>{{ $centro->correoElectronicoSubdirector }}</td>
                        <td>{{ $centro->numeroCelularSubdirector }}</td>
                        <td>
                            <div class="dropdown acciones">
                                <button class="btn btn-transparent btn-sm dropdown-toggle" type="button" id="acciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu" aria-labelledby="acciones">
                                    @can ('editar-informacion')
                                        <a href="{{ route('centros_formacion.edit', $centro->id) }}" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Editar datos</a>
                                    @endcan
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <hr>

        <h4>Información líder SENNOVA</h4>

        <table class="table table-custom dataTable" data-page-length="50">
            <thead>
                <tr>
                    <th>Nombre líder SENNOVA</th>
                    <th>Correo electrónico líder SENNOVA</th>
                    <th>Número celular líder SENNOVA</th>

                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($centroFormacion as $centro)
                    <tr>
                        <td>{{ $centro->nombreLiderSennova }}</td>
                        <td>{{ $centro->correoElectronicoLiderSennova }}</td>
                        <td>{{ $centro->numeroCelularLiderSennova }}</td>
                        <td>
                            <div class="dropdown acciones">
                                <button class="btn btn-transparent btn-sm dropdown-toggle" type="button" id="acciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu" aria-labelledby="acciones">
                                    @can ('editar-informacion')
                                        <a href="{{ route('centros_formacion.edit', $centro->id) }}" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Editar datos</a>
                                    @endcan
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
