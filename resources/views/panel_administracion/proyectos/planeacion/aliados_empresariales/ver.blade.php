@extends('layouts.app')

@section('content')
    @push('planeacion')
        @component('partials.menu-planeacion', ['proyecto' => $proyecto, 'idObjetivoEspecifico' => $proyecto->objetivosEspecificos->first()->id])

        @endcomponent

    @endpush
    <div class="container">
        <a href="{{ route('aliados.index', $proyecto->id) }}" class="btn btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>

        <h1>Aliados empresariales</h1>

        @if ($aliado->evaluacion)
            @if ($aliado->evaluacion->recomendacion)
                <div class="alert alert-danger" role="alert">
                    <strong>Recomendación: </strong>{{ $aliado->evaluacion->recomendacion }} <a href="{{ route('aliados.edit', [$proyecto->id, $aliado->id]) }}" class="text-danger d-block"><u>Por favor realiza la correción</u></a>
                    <p><strong>Última fecha de evaluación: </strong><span class="fecha">{{ $aliado->evaluacion->updated_at }}</span></p>
                </div>
            @endif
        @endif

        <div class="row">
            <div class="col-md-4">
                <p><strong>Nombre del aliado externo</strong></p>
            </div>
            <div class="col-md-7">
                <p>{{ $aliado->nombreAliado }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p><strong>NIT</strong></p>
            </div>
            <div class="col-md-7">
                <p>{{ $aliado->nit }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p><strong>Nombre del contacto</strong></p>
            </div>
            <div class="col-md-7">
                <p>{{ $aliado->nombre }}"</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p><strong>Número de celular del contacto</strong></p>
            </div>
            <div class="col-md-7">
                <a href="tel:{{ $aliado->celular }}">{{ $aliado->celular }}</a>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4">
                <p><strong>Correo electrónico del contacto</strong></p>
            </div>
            <div class="col-md-7">
                <a href="mailto:{{ $aliado->email }}">{{ $aliado->email }}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p><strong>Convenio</strong></p>
            </div>
            <div class="col-md-7">
                <p>
                    <a href="{{ route('aliados.descargarCartaConvenio', $aliado->id) }}"><i class="far fa-arrow-alt-circle-down"></i> Descargar carta de convenio</a>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p><strong>Recursos en especie de entidad externa ($COP)</strong></p>
            </div>
            <div class="col-md-7">
                <p>$ {{ number_format($aliado->recursosEspecie, 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p><strong>Recursos en dinero de entidad externa ($COP)</strong></p>
            </div>
            <div class="col-md-7">
                <p>$ {{ number_format($aliado->recursosDinero, 0, ',', '.') }}</p>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4">
                <p><strong>Ciudades y/o municipios de influencia</strong></p>
            </div>
            <div class="col-md-7">
                <p>{{ $aliado->ciudadesMunicipiosInfluencia }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p><strong>Última actualización</strong></p>
            </div>
            <div class="col-md-7">
                <p class="fecha">{{ $aliado->updated_at != null ? $aliado->updated_at : '2018-07-08' }}</p>
            </div>
        </div>
    </div>
@endsection
