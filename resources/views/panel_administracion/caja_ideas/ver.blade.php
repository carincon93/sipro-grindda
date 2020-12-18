@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mt-5">
            <h3>{{ $idea->nombreEmpresa }}</h3>

            <h5>Descripción de la idea</h5>
            <p>{{ $idea->idea }}</p>

            <h5>Presupuesto</h5>
            <p><strong>$ {{number_format($idea->presupuesto, 0, ',', '.')}}</strong></p>

            <table class="table table-custom dataTable" data-page-length="50">
                <thead>
                    <tr>
                        <th>NIT</th>
                        <th>Representante legal</th>
                        <th>Sector de la empresa</th>
                        <th>Persona encargada de proyectos</th>
                        <th>Teléfono celular</th>
                        <th>Teléfono Fijo</th>
                        <th>Dirección de correo electrónico</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $idea->nit }}</td>
                        <td>{{ $idea->representanteLegal }}</td>
                        <td>{{ $idea->sectorEmpresa }}</td>
                        <td>{{ $idea->nombrePersona }}</td>
                        <td>{{ $idea->telefonoCelular }}</td>
                        <td>{{ $idea->telefonoFijo }}</td>
                        <td>{{ $idea->correoElectronico }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
