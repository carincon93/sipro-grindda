@extends('layouts.app')

@section('body_class', 'panel-planeacion')

@section('content')

    <div class="tab-content" id="pills-tabContent">

        @include('partials.menu-evaluacion', ['proyecto' => $proyecto])

        @push('planeacion')
            @include('partials.navbar-evaluacion-tecnica')
        @endpush

        @include('partials.messages')

        <div class="tab-content panel-principal">

            <p class="mt-5 pl-4">Enviar evaluación</p>
            <h3 class="descripcion-objetivo-especifico">{{ $proyecto->titulo }}</h3>

            @if ($proyecto->modificado)
                <div class="datos-planeacion shadow p-4">
                    <div>Total ítems evaluados (Cumplimiento): {{ $proyecto->proyectoAprobacion()->totalEvaluaciones }}</div>
                    <div>Total ítems aprobados: {{ $proyecto->proyectoAprobacion()->totalEvaluacionesSi }}</div>
                    @if ($proyecto->proyectoAprobacion()->totalEvaluaciones != 0 && $proyecto->proyectoAprobacion()->totalEvaluacionesSi != 0)
                        @php
                            $porcentaje = ($proyecto->proyectoAprobacion()->totalEvaluacionesSi / $proyecto->proyectoAprobacion()->totalEvaluaciones) * 100;
                        @endphp
                        <div>Porcentaje de aprobación: {{ number_format($porcentaje, 2, '.', ',') }} %</div>

                        <div>
                            Estado:
                            @if ( $porcentaje > 80 )
                                Viable

                                <form class="" action="{{ route('proyectos.guardarEstado', $proyecto->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="estado" value="Viable">
                                    <input type="hidden" name="porcentaje" value="{{ $porcentaje }}">
                                    <button class="btn btn-primary" type="submit">Guardar estado</button>
                                </form>
                            @else
                                No viable
                                <form class="" action="{{ route('proyectos.guardarEstado', $proyecto->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="estado" value="No viable">
                                    <input type="hidden" name="porcentaje" value="{{ $porcentaje }}">
                                    <button class="btn btn-primary" type="submit">Guardar estado</button>
                                </form>
                            @endif
                        </div>
                    @endif

                </div>
            @else
                <form action="{{ route('evaluacion.guardarEvaluacion', $proyecto->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="datos-planeacion shadow p-4">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-9">
                                    <p>¿Desea enviar esta evaluación al autor/autores para su correción?</p>
                                    <button type="submit" class="btn btn-primary">Enviar evaluación</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection
