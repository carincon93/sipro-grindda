@extends('layouts.app')

@section('content')
    @push('planeacion')
        @component('partials.menu-planeacion', ['proyecto' => $proyecto, 'idObjetivoEspecifico' => $proyecto->objetivosEspecificos->first()->id])

        @endcomponent

    @endpush
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>

        <h1>Presupuesto empresarial</h1>

        @if ($presupuesto->evaluacion)
            @if ($presupuesto->evaluacion->recomendacion)
                <div class="alert alert-danger" role="alert">
                    <strong>Recomendación: </strong>{{ $presupuesto->evaluacion->recomendacion }} <a href="{{ route('presupuestos_empresariales.edit', [$proyecto->id, $presupuesto->id]) }}" class="text-danger d-block"><u>Por favor realiza la correción</u></a>
                    <p><strong>Última fecha de evaluación: </strong><span class="fecha">{{ $presupuesto->evaluacion->updated_at }}</span></p>
                </div>
            @endif
        @endif


        <div class="row">
            <div class="col-md-4">
                <p><strong>Nombre del presupuesto</strong></p>
            </div>
            <div class="col-md-7">
                <p>{{ $presupuesto->nombreItem }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p><strong>Valor del presupuesto</strong></p>
            </div>
            <div class="col-md-7">
                <p>$ {{ number_format($presupuesto->valor, 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p><strong>Descripción</strong></p>
            </div>
            <div class="col-md-7">
                <p>{{ $presupuesto->descripcion }}</p>
            </div>
        </div>
        @if ($presupuesto->archivo !== null)
            <div class="row">
                <div class="col-md-4">
                    <p><strong>Anexo</strong></p>
                </div>
                <div class="col-md-7">
                    <a href="{{ route('presupuestos_sennova.descargarCartaPresupuesto', $presupuesto->id) }}"><i class="far fa-arrow-alt-circle-down"></i> Descargar anexo</a>
                </div>
            </div>            
        @endif
        <div class="row">
            <div class="col-md-4">
                <p><strong>Última actualización</strong></p>
            </div>
            <div class="col-md-7">
                <p class="fecha">{{ $presupuesto->updated_at != null ? $presupuesto->updated_at : '2018-07-08' }}</p>
            </div>
        </div>
    </div>
@endsection
