@extends('layouts.app')

@section('content')
    @push('planeacion')
        @component('partials.menu-planeacion', ['proyecto' => $proyecto, 'idObjetivoEspecifico' => $proyecto->objetivosEspecificos->first()->id])

        @endcomponent

    @endpush
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>

        <h1>Recurso humano</h1>

        @if ($recursoHumano->evaluacion)
            @if ($recursoHumano->evaluacion->recomendacion)
                <div class="alert alert-danger" role="alert">
                    <strong>Recomendación: </strong>{{ $recursoHumano->evaluacion->recomendacion }} <a href="{{ route('recursos_humanos.edit', [$proyecto->id, $recursoHumano->id]) }}" class="text-danger d-block"><u>Por favor realiza la correción</u></a>
                    <p><strong>Última fecha de evaluación: </strong><span class="fecha">{{ $recursoHumano->evaluacion->updated_at }}</span></p>
                </div>
            @endif
        @endif

        <div class="row">
            <div class="col-md-4">
                <p><strong>Nombre del personal</strong></p>
            </div>
            <div class="col-md-7">
                <p>{{ $recursoHumano->nombrePersonal }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p><strong>Número de documento</strong></p>
            </div>
            <div class="col-md-7">
                <p>{{ $recursoHumano->numeroDocumentoPersonal }}</p>
            </div>
        </div>
        @if ($recursoHumano->personalInstructor == true)
            <div class="row">
                <div class="col-md-4">
                    <p><strong>Número de documento</strong></p>
                </div>
                <div class="col-md-7">
                    <a href="{{ route('recursos_humanos.descargarCartaCompromiso', $recursoHumano->id) }}"><i class="far fa-arrow-alt-circle-down"></i> Descargar carta de compromiso</a>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-4">
                <p><strong>Última actualización</strong></p>
            </div>
            <div class="col-md-7">
                <p class="fecha">{{ $recursoHumano->updated_at != null ? $recursoHumano->updated_at : '2018-07-08' }}</p>
            </div>
        </div>
    </div>
@endsection
