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

            <p class="mt-5 pl-4">Evaluación de proyecto</p>
            <form action="{{ route('proyectos.guardarEvaluacion', $proyecto->id) }}" method="POST" enctype="multipart/form-data" class="formular-proyecto">
                @csrf
                <div class="datos-planeacion shadow p-4">
                    <div class="col-md-12">
                        <span><strong>Título del proyecto</strong></span>
                        <p class="h3">
                            {{ $proyecto->titulo }}
                        </p>
                        <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                            <label class="col-md-3" for="recomendacion-titulo">Recomendación</label>
                            <div class="col-md-7">
                                <textarea id="recomendacion-titulo" name="recomendacionTitulo" rows="6" cols="80" class="form-control">{{ $proyecto->obtenerRecomendacion($proyecto, 'titulo') != null ? $proyecto->obtenerRecomendacion($proyecto, 'titulo')->recomendacion : '' }}</textarea>
                            </div>
                        </div>
                        @if ($proyecto->modificado)
                            <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                <label class="col-md-3" for="cumplimiento-titulo">
                                    ¿Cumple?
                                    <div id="titulo" class="text-success"></div>
                                </label>
                                <div class="col-md-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if ($proyecto->obtenerRecomendacion($proyecto, 'titulo'))
                                            <input type="radio" name="cumplimientoTitulo" id="cumplimientoTituloSi" value="si" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'titulo')->cumplimiento == 'si' ? 'checked' : '' }}>
                                        @else
                                            <input type="radio" name="cumplimientoTitulo" id="cumplimientoTituloSi" value="si" class="custom-control-input">
                                        @endif
                                        <label class="custom-control-label" for="cumplimientoTituloSi">Si</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if ($proyecto->obtenerRecomendacion($proyecto, 'titulo'))
                                            <input type="radio" name="cumplimientoTitulo" id="cumplimientoTituloNo" value="no" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'titulo')->cumplimiento == 'no' ? 'checked' : '' }}>
                                        @else
                                            <input type="radio" name="cumplimientoTitulo" id="cumplimientoTituloNo" value="no" class="custom-control-input">
                                        @endif
                                        <label class="custom-control-label" for="cumplimientoTituloNo">No</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="datos-planeacion shadow p-4">
                    <div class="row">
                        <label class="col-md-3 text-md-left"><strong>Tipo de proyecto</strong></label>
                        <div class="col-md-7">
                            <p>
                                {{ $proyecto->tipoProyecto }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="datos-planeacion shadow p-4">
                    <div class="col-md-12">
                        <div class="row">
                            <label class="col-md-3 col-form-label text-md-left" for="programasFormacion"><strong>Líneas de investigación asociadas</strong></label>
                            <div class="col-md-7">
                                <ul class="pl-3 m-2">
                                    @forelse ($proyecto->lineasInvestigacion as $key => $lineaInvestigacion)
                                        <li>{{ $lineaInvestigacion->nombre }}</li>
                                    @empty
                                        <li>No hay líneas de investigación asociadas</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                            <label class="col-md-3" for="recomendacion-lineasInvestigacion">Recomendación</label>
                            <div class="col-md-7">
                                <textarea id="recomendacion-lineasInvestigacion" name="recomendacionLineasInvestigacion" rows="6" cols="80" class="form-control">{{ $proyecto->obtenerRecomendacion($proyecto, 'lineasInvestigacion') != null ? $proyecto->obtenerRecomendacion($proyecto, 'lineasInvestigacion')->recomendacion : '' }}</textarea>
                            </div>
                        </div>

                        @if ($proyecto->modificado)
                            <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                <label class="col-md-3" for="cumplimiento-lineasInvestigacion">
                                    ¿Cumple?
                                    <div id="lineasInvestigacion" class="text-success"></div>
                                </label>
                                <div class="col-md-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if ($proyecto->obtenerRecomendacion($proyecto, 'lineasInvestigacion'))
                                            <input type="radio" name="cumplimientoLineasInvestigacion" id="cumplimientoLineasInvestigacionSi" value="si" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'programasFormacion')->cumplimiento == 'si' ? 'checked' : '' }}>
                                        @else
                                            <input type="radio" name="cumplimientoLineasInvestigacion" id="cumplimientoLineasInvestigacionSi" value="si" class="custom-control-input">
                                        @endif
                                        <label class="custom-control-label" for="cumplimientoLineasInvestigacionSi">Si</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if ($proyecto->obtenerRecomendacion($proyecto, 'programasFormacion'))
                                            <input type="radio" name="cumplimientoLineasInvestigacion" id="cumplimientoLineasInvestigacionNo" value="no" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'programasFormacion')->cumplimiento == 'no' ? 'checked' : '' }}>
                                        @else
                                            <input type="radio" name="cumplimientoLineasInvestigacion" id="cumplimientoLineasInvestigacionNo" value="no" class="custom-control-input">
                                        @endif
                                        <label class="custom-control-label" for="cumplimientoLineasInvestigacionNo">No</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="datos-planeacion shadow p-4">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="col-form-label text-md-left"><strong>Autor(es) - Coautor(es) del proyecto</strong></label>
                        </div>
                        <div class="col-md-7">
                            <ul class="pl-3 m-2">
                                @foreach ($proyecto->autores as $key => $autor)
                                    <li>{{ $autor->nombre }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="datos-planeacion shadow p-4">
                    <div class="row">
                        <label class="col-md-3 col-form-label text-md-left" for="areaConocimiento1"><strong>#1 Área de conocimiento</strong></label>
                        <div class="col-md-7">
                            <p>{{ $proyecto->areaConocimiento1 }}</p>
                        </div>
                    </div>
                </div>

                @isset($proyecto->areaConocimiento2)
                    <div class="datos-planeacion shadow p-4">
                        <div class="row">
                            <label class="col-md-3 col-form-label text-md-left" for="areaConocimiento2"><strong>#2 Área de conocimiento</strong></label>
                            <div class="col-md-7">
                                <p>{{ $proyecto->areaConocimiento2 }}</p>
                            </div>
                        </div>
                    </div>
                @endisset

                <div class="datos-planeacion shadow p-4">
                    <div class="col-md-12">
                        <div class="row">
                            <label class="col-md-3 col-form-label text-md-left" for="antecedentesJustificacionProyecto"><strong>Antecedentes y justificación</strong></label>
                            <div class="col-md-7">
                                <p class="text-justify">
                                    {{ $proyecto->antecedentesJustificacionProyecto }}
                                </p>
                            </div>
                        </div>
                        <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                            <label class="col-md-3" for="recomendacion-justificacion">Recomendación</label>
                            <div class="col-md-7">
                                <textarea id="recomendacion-justificacion" name="recomendacionJustificacion" rows="6" cols="80" class="form-control">{{ $proyecto->obtenerRecomendacion($proyecto, 'antecedentesJustificacionProyecto') != null ? $proyecto->obtenerRecomendacion($proyecto, 'antecedentesJustificacionProyecto')->recomendacion : '' }}</textarea>
                            </div>
                        </div>
                        @if ($proyecto->modificado)
                            <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                <label class="col-md-3" for="cumplimiento-atencedentes">
                                    ¿Cumple?
                                    <div id="antecedentesJustificacionProyecto" class="text-success"></div>
                                </label>
                                <div class="col-md-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if ($proyecto->obtenerRecomendacion($proyecto, 'antecedentesJustificacionProyecto'))
                                            <input type="radio" name="cumplimientoJustificacion" id="cumplimientoJustificacionSi" value="si" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'antecedentesJustificacionProyecto')->cumplimiento == 'si' ? 'checked' : '' }}>
                                        @else
                                            <input type="radio" name="cumplimientoJustificacion" id="cumplimientoJustificacionSi" value="si" class="custom-control-input">
                                        @endif
                                        <label class="custom-control-label" for="cumplimientoJustificacionSi">Si</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if ($proyecto->obtenerRecomendacion($proyecto, 'antecedentesJustificacionProyecto'))
                                            <input type="radio" name="cumplimientoJustificacion" id="cumplimientoJustificacionNo" value="no" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'antecedentesJustificacionProyecto')->cumplimiento == 'no' ? 'checked' : '' }}>
                                        @else
                                            <input type="radio" name="cumplimientoJustificacion" id="cumplimientoJustificacionNo" value="no" class="custom-control-input">
                                        @endif
                                        <label class="custom-control-label" for="cumplimientoJustificacionNo">No</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="datos-planeacion shadow p-4">
                    <div class="col-md-12">
                        <div class="row">
                            <label class="col-md-3 col-form-label text-md-left" for="planteamientoProblema"><strong>Planteamiento del problema</strong></label>
                            <div class="col-md-7">
                                <p class="text-justify">
                                    {{ $proyecto->planteamientoProblema }}
                                </p>
                            </div>
                        </div>
                        <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                            <label class="col-md-3" for="recomendacion-problema">Recomendación</label>
                            <div class="col-md-7">
                                <textarea id="recomendacion-problema" name="recomendacionProblema" rows="6" cols="80" class="form-control">{{ $proyecto->obtenerRecomendacion($proyecto, 'problema') != null ? $proyecto->obtenerRecomendacion($proyecto, 'problema')->recomendacion : '' }}</textarea>
                            </div>
                        </div>

                        @if ($proyecto->modificado)
                            <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                <label class="col-md-3" for="cumplimiento-problema">
                                    ¿Cumple?
                                    <div id="problema" class="text-success"></div>
                                </label>
                                <div class="col-md-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if ($proyecto->obtenerRecomendacion($proyecto, 'problema'))
                                            <input type="radio" name="cumplimientoProblema" id="cumplimientoProblemaSi" value="si" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'problema')->cumplimiento == 'si' ? 'checked' : '' }}>
                                        @else
                                            <input type="radio" name="cumplimientoProblema" id="cumplimientoProblemaSi" value="si" class="custom-control-input">
                                        @endif
                                        <label class="custom-control-label" for="cumplimientoProblemaSi">Si</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if ($proyecto->obtenerRecomendacion($proyecto, 'problema'))
                                            <input type="radio" name="cumplimientoProblema" id="cumplimientoProblemaNo" value="no" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'problema')->cumplimiento == 'no' ? 'checked' : '' }}>
                                        @else
                                            <input type="radio" name="cumplimientoProblema" id="cumplimientoProblemaNo" value="no" class="custom-control-input">
                                        @endif
                                        <label class="custom-control-label" for="cumplimientoProblemaNo">No</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="datos-planeacion shadow p-4">
                    <div class="col-md-12">
                        <div class="row">
                            <label class="col-md-3 col-form-label text-md-left" for="metodologia"><strong>Metodología</strong></label>
                            <div class="col-md-7">
                                <p class="text-justify">
                                    {{ $proyecto->metodologia }}
                                </p>
                            </div>
                        </div>
                        <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                            <label class="col-md-3" for="recomendacion-metodologia">Recomendación</label>
                            <div class="col-md-7">
                                <textarea id="recomendacion-metodologia" name="recomendacionMetodologia" rows="6" cols="80" class="form-control">{{ $proyecto->obtenerRecomendacion($proyecto, 'metodologia') != null ? $proyecto->obtenerRecomendacion($proyecto, 'metodologia')->recomendacion : '' }}</textarea>
                            </div>
                        </div>

                        @if ($proyecto->modificado)
                            <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                <label class="col-md-3" for="cumplimiento-metodologia">
                                    ¿Cumple?
                                    <div id="metodologia" class="text-success"></div>
                                </label>
                                <div class="col-md-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if ($proyecto->obtenerRecomendacion($proyecto, 'metodologia'))
                                            <input type="radio" name="cumplimientoMetodologia" id="cumplimientoMetodologiaSi" value="si" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'metodologia')->cumplimiento == 'si' ? 'checked' : '' }}>
                                        @else
                                            <input type="radio" name="cumplimientoMetodologia" id="cumplimientoMetodologiaSi" value="si" class="custom-control-input">
                                        @endif
                                        <label class="custom-control-label" for="cumplimientoMetodologiaSi">Si</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if ($proyecto->obtenerRecomendacion($proyecto, 'metodologia'))
                                            <input type="radio" name="cumplimientoMetodologia" id="cumplimientoMetodologiaNo" value="no" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'metodologia')->cumplimiento == 'no' ? 'checked' : '' }}>
                                        @else
                                            <input type="radio" name="cumplimientoMetodologia" id="cumplimientoMetodologiaNo" value="no" class="custom-control-input">
                                        @endif
                                        <label class="custom-control-label" for="cumplimientoMetodologiaNo">No</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="datos-planeacion shadow p-4">
                    <div class="col-md-12">
                        <div class="row">
                            <label class="col-md-3 col-form-label text-md-left" for="objetivoGeneral"><strong>Objetivo general</strong></label>
                            <div class="col-md-7">
                                <p class="text-justify">
                                    {{ $proyecto->objetivoGeneral }}
                                </p>
                            </div>
                        </div>
                        <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                            <label class="col-md-3" for="recomendacion-objetivoGeneral">Recomendación</label>
                            <div class="col-md-7">
                                <textarea id="recomendacion-objetivoGeneral" name="recomendacionObjetivoGeneral" rows="6" cols="80" class="form-control">{{ $proyecto->obtenerRecomendacion($proyecto, 'objetivoGeneral') != null ? $proyecto->obtenerRecomendacion($proyecto, 'objetivoGeneral')->recomendacion : '' }}</textarea>
                            </div>
                        </div>

                        @if ($proyecto->modificado)
                            <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                <label class="col-md-3" for="cumplimiento-general">
                                    ¿Cumple?
                                    <div id="objetivoGeneral" class="text-success"></div>
                                </label>
                                <div class="col-md-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if ($proyecto->obtenerRecomendacion($proyecto, 'objetivoGeneral'))
                                            <input type="radio" name="cumplimientoObjetivoGeneral" id="cumplimientoObjetivoGeneralSi" value="si" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'objetivoGeneral')->cumplimiento == 'si' ? 'checked' : '' }}>
                                        @else
                                            <input type="radio" name="cumplimientoObjetivoGeneral" id="cumplimientoObjetivoGeneralSi" value="si" class="custom-control-input">
                                        @endif
                                        <label class="custom-control-label" for="cumplimientoObjetivoGeneralSi">Si</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if ($proyecto->obtenerRecomendacion($proyecto, 'objetivoGeneral'))
                                            <input type="radio" name="cumplimientoObjetivoGeneral" id="cumplimientoObjetivoGeneralNo" value="no" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'objetivoGeneral')->cumplimiento == 'no' ? 'checked' : '' }}>
                                        @else
                                            <input type="radio" name="cumplimientoObjetivoGeneral" id="cumplimientoObjetivoGeneralNo" value="no" class="custom-control-input">
                                        @endif
                                        <label class="custom-control-label" for="cumplimientoObjetivoGeneralNo">No</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                @foreach ($proyecto->objetivosEspecificos as $key => $objetivoEspecifico)
                    <div class="datos-planeacion shadow p-4">
                        <div class="col-md-12">
                            <div class="row">
                                <label class="col-md-3 col-form-label text-md-left" for="objetivoEspecifico"><strong>Objetivo específico {{ $key + 1 }}</strong></label>
                                <div class="col-md-7">
                                    <p class="text-justify">
                                        {{ $objetivoEspecifico->descripcion }}
                                    </p>
                                </div>
                            </div>
                            <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                <label class="col-md-3" for="recomendacion-objetivoEspecifico{{ $key + 1 }}">Recomendación</label>
                                <div class="col-md-7">
                                    <textarea id="recomendacion-objetivoEspecifico{{ $key + 1 }}" name="recomendacionObjetivoEspecifico{{ $key + 1 }}" rows="6" cols="80" class="form-control">{{ !empty($objetivoEspecifico->evaluacion) ? $objetivoEspecifico->evaluacion->recomendacion : '' }}</textarea>
                                    <input type="hidden" name="idObjetivoEspecifico{{ $key + 1 }}" value="{{ $objetivoEspecifico->id }}">
                                </div>
                            </div>

                            @if ($proyecto->modificado)
                                <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                    <label class="col-md-3" for="cumplimiento-especifico">
                                        ¿Cumple?
                                        <div id="objetivoEspecifico{{ $key + 1}}" class="text-success"></div>
                                    </label>
                                    <div class="col-md-7">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            @if ($objetivoEspecifico->evaluacion)
                                                <input type="radio" name="cumplimientoObjetivoEspecifico{{ $key + 1 }}" id="cumplimientoObjetivoEspecifico{{ $key + 1 }}Si" value="si" class="custom-control-input" {{ $objetivoEspecifico->evaluacion->cumplimiento == 'si' ? 'checked' : '' }}>
                                            @else
                                                <input type="radio" name="cumplimientoObjetivoEspecifico{{ $key + 1 }}" id="cumplimientoObjetivoEspecifico{{ $key + 1 }}Si" value="si" class="custom-control-input">
                                            @endif
                                            <label class="custom-control-label" for="cumplimientoObjetivoEspecifico{{ $key + 1 }}Si">Si</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            @if ($objetivoEspecifico->evaluacion)
                                                <input type="radio" name="cumplimientoObjetivoEspecifico{{ $key + 1 }}" id="cumplimientoObjetivoEspecifico{{ $key + 1 }}No" value="no" class="custom-control-input" {{ $objetivoEspecifico->evaluacion->cumplimiento == 'no' ? 'checked' : '' }}>
                                            @else
                                                <input type="radio" name="cumplimientoObjetivoEspecifico{{ $key + 1 }}" id="cumplimientoObjetivoEspecifico{{ $key + 1 }}No" value="no" class="custom-control-input">
                                            @endif
                                            <label class="custom-control-label" for="cumplimientoObjetivoEspecifico{{ $key + 1 }}No">No</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- <evaluacion-objetivo-especifico :index="{{$key+1}}" :idobjesp="{{$objetivoEspecifico->id}}" ></evaluacion-objetivo-especifo> --}}

                @endforeach

                <div class="datos-planeacion shadow p-4">
                    <div class="row">
                        <label class="col-md-3 col-form-label text-md-left" for="fechaInicioProyecto"><strong>Fecha de inicio del proyecto</strong></label>
                        <div class="col-md-7">
                            {{-- <input id="fechaInicioProyecto" type="date" name="fechaInicioProyecto" value="" class="form-control"> --}}
                            <p class="text-justify fecha">
                                {{ $proyecto->fechaInicioProyecto }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="datos-planeacion shadow p-4">
                    <div class="row">
                        <label class="col-md-3 col-form-label text-md-left" for="fechaFinProyecto"><strong>Fecha final del proyecto</strong></label>
                        <div class="col-md-7">
                            {{-- <input id="fechaFinProyecto" type="date" name="fechaFinProyecto" value="" class="form-control"> --}}
                            <p class="text-justify fecha">
                                {{ $proyecto->fechaFinProyecto }}
                            </p>
                        </div>
                    </div>
                </div>
                @isset($proyecto->grupoInvestigacion)
                    <div class="datos-planeacion shadow p-4">
                        <div class="row">
                            <label class="col-md-3 col-form-label text-md-left" for="grupoInvestigacion"><strong>Grupo de investigación</strong></label>
                            <div class="col-md-7">
                                <p class="text-justify">
                                    {{ $proyecto->grupoInvestigacion->nombre }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endisset
                @isset($proyecto->codigoGruplac)
                    <div class="datos-planeacion shadow p-4">
                        <div class="row">
                            <label class="col-md-3 col-form-label text-md-left" for="codigoGruplac"><strong>Código Gruplac</strong></label>
                            <div class="col-md-7">
                                <p class="text-justify">
                                    {{ $proyecto->codigoGruplac }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endisset

                <div class="datos-planeacion shadow p-4">
                    <div class="col-md-12">
                        <div class="row">
                            <label class="col-md-3 col-form-label text-md-left" for="semilleros"><strong>Semilleros beneficiados</strong></label>
                            <div class="col-md-7">
                                <ul class="pl-3 m-2">
                                    @foreach ($proyecto->semilleros as $key => $semillero)
                                        <li>{{ $semillero->nombre }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                            <label class="col-md-3" for="recomendacion-semilleros">Recomendación</label>
                            <div class="col-md-7">
                                <textarea id="recomendacion-semilleros" name="recomendacionSemilleros" rows="6" cols="80" class="form-control">{{ $proyecto->obtenerRecomendacion($proyecto, 'semilleros') != null ? $proyecto->obtenerRecomendacion($proyecto, 'semilleros')->recomendacion : '' }}</textarea>
                            </div>
                        </div>

                        @if ($proyecto->modificado)
                            <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                <label class="col-md-3" for="cumplimiento-semilleros">
                                    ¿Cumple?
                                    <div id="semilleros" class="text-success"></div>
                                </label>
                                <div class="col-md-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if ($proyecto->obtenerRecomendacion($proyecto, 'semilleros'))
                                            <input type="radio" name="cumplimientoSemilleros" id="cumplimientoSemillerosSi" value="si" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'semilleros')->cumplimiento == 'si' ? 'checked' : '' }}>
                                        @else
                                            <input type="radio" name="cumplimientoSemilleros" id="cumplimientoSemillerosSi" value="si" class="custom-control-input">
                                        @endif
                                        <label class="custom-control-label" for="cumplimientoSemillerosSi">Si</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if ($proyecto->obtenerRecomendacion($proyecto, 'semilleros'))
                                            <input type="radio" name="cumplimientoSemilleros" id="cumplimientoSemillerosNo" value="no" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'semilleros')->cumplimiento == 'no' ? 'checked' : '' }}>
                                        @else
                                            <input type="radio" name="cumplimientoSemilleros" id="cumplimientoSemillerosNo" value="no" class="custom-control-input">
                                        @endif
                                        <label class="custom-control-label" for="cumplimientoSemillerosNo">No</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="datos-planeacion shadow p-4">
                    <div class="col-md-12">
                        <div class="row">
                            <label class="col-md-3 col-form-label text-md-left" for="programasFormacion"><strong>Programas de formación beneficiados</strong></label>
                            <div class="col-md-7">
                                <ul class="pl-3 m-2">
                                    @forelse ($proyecto->programasFormacion as $key => $programa)
                                        <li>{{ $programa->nombre }}</li>
                                    @empty
                                        <li>No hay programas de formación beneficiados</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                            <label class="col-md-3" for="recomendacion-programasFormacion">Recomendación</label>
                            <div class="col-md-7">
                                <textarea id="recomendacion-programasFormacion" name="recomendacionProgramasFormacion" rows="6" cols="80" class="form-control">{{ $proyecto->obtenerRecomendacion($proyecto, 'programasFormacion') != null ? $proyecto->obtenerRecomendacion($proyecto, 'programasFormacion')->recomendacion : '' }}</textarea>
                            </div>
                        </div>

                        @if ($proyecto->modificado)
                            <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                <label class="col-md-3" for="cumplimiento-programasFormacion">
                                    ¿Cumple?
                                    <div id="programasFormacion" class="text-success"></div>
                                </label>
                                <div class="col-md-7">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if ($proyecto->obtenerRecomendacion($proyecto, 'programasFormacion'))
                                            <input type="radio" name="cumplimientoProgramasFormacion" id="cumplimientoProgramasFormacionSi" value="si" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'programasFormacion')->cumplimiento == 'si' ? 'checked' : '' }}>
                                        @else
                                            <input type="radio" name="cumplimientoProgramasFormacion" id="cumplimientoProgramasFormacionSi" value="si" class="custom-control-input">
                                        @endif
                                        <label class="custom-control-label" for="cumplimientoProgramasFormacionSi">Si</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if ($proyecto->obtenerRecomendacion($proyecto, 'programasFormacion'))
                                            <input type="radio" name="cumplimientoProgramasFormacion" id="cumplimientoProgramasFormacionNo" value="no" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'programasFormacion')->cumplimiento == 'no' ? 'checked' : '' }}>
                                        @else
                                            <input type="radio" name="cumplimientoProgramasFormacion" id="cumplimientoProgramasFormacionNo" value="no" class="custom-control-input">
                                        @endif
                                        <label class="custom-control-label" for="cumplimientoProgramasFormacionNo">No</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                @isset($proyecto->impactoSocial)
                    <div class="datos-planeacion shadow p-4">
                        <div class="col-md-12">
                            <div class="row">
                                <label class="col-md-3 col-form-label text-md-left" for="impactoSocial"><strong>Impacto social</strong></label>
                                <div class="col-md-7">
                                    <p class="text-justify">{{ $proyecto->impactoSocial }}</p>
                                </div>
                            </div>
                            <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                <label class="col-md-3" for="recomendacion-impactoSocial">Recomendación</label>
                                <div class="col-md-7">
                                    <textarea id="recomendacion-impactoSocial" name="recomendacionImpactoSocial" rows="6" cols="80" class="form-control">{{ $proyecto->obtenerRecomendacion($proyecto, 'impactoSocial') != null ? $proyecto->obtenerRecomendacion($proyecto, 'impactoSocial')->recomendacion : '' }}</textarea>
                                </div>
                            </div>

                            @if ($proyecto->modificado)
                                <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                    <label class="col-md-3" for="cumplimiento-impactoSocial">
                                        ¿Cumple?
                                        <div id="impactoSocial" class="text-success"></div>
                                    </label>
                                    <div class="col-md-7">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            @if ($proyecto->obtenerRecomendacion($proyecto, 'impactoSocial'))
                                                <input type="radio" name="cumplimientoImpactoSocial" id="cumplimientoImpactoSocialSi" value="si" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'impactoSocial')->cumplimiento == 'si' ? 'checked' : '' }}>
                                            @else
                                                <input type="radio" name="cumplimientoImpactoSocial" id="cumplimientoImpactoSocialSi" value="si" class="custom-control-input">
                                            @endif
                                            <label class="custom-control-label" for="cumplimientoImpactoSocialSi">Si</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            @if ($proyecto->obtenerRecomendacion($proyecto, 'impactoSocial'))
                                                <input type="radio" name="cumplimientoImpactoSocial" id="cumplimientoImpactoSocialNo" value="no" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'impactoSocial')->cumplimiento == 'no' ? 'checked' : '' }}>
                                            @else
                                                <input type="radio" name="cumplimientoImpactoSocial" id="cumplimientoImpactoSocialNo" value="no" class="custom-control-input">
                                            @endif
                                            <label class="custom-control-label" for="cumplimientoImpactoSocialNo">No</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endisset
                @isset($proyecto->impactoEconomico)
                    <div class="datos-planeacion shadow p-4">
                        <div class="col-md-12">
                            <div class="row">
                                <label class="col-md-3 col-form-label text-md-left" for="impactoEconomico"><strong>Impacto económico</strong></label>
                                <div class="col-md-7">
                                    <p class="text-justify">{{ $proyecto->impactoEconomico }}</p>
                                </div>
                            </div>
                            <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                <label class="col-md-3" for="recomendacion-impactoEconomico">Recomendación</label>
                                <div class="col-md-7">
                                    <textarea id="recomendacion-impactoEconomico" name="recomendacionImpactoEconomico" rows="6" cols="80" class="form-control">{{ $proyecto->obtenerRecomendacion($proyecto, 'impactoEconomico') != null ? $proyecto->obtenerRecomendacion($proyecto, 'impactoEconomico')->recomendacion : '' }}</textarea>
                                </div>
                            </div>

                            @if ($proyecto->modificado)
                                <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                    <label class="col-md-3" for="cumplimiento-impactoEconomico">
                                        ¿Cumple?
                                        <div id="impactoEconomico" class="text-success"></div>
                                    </label>
                                    <div class="col-md-7">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            @if ($proyecto->obtenerRecomendacion($proyecto, 'impactoEconomico'))
                                                <input type="radio" name="cumplimientoImpactoEconomico" id="cumplimientoImpactoEconomicoSi" value="si" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'impactoEconomico')->cumplimiento == 'si' ? 'checked' : '' }}>
                                            @else
                                                <input type="radio" name="cumplimientoImpactoEconomico" id="cumplimientoImpactoEconomicoSi" value="si" class="custom-control-input">
                                            @endif
                                            <label class="custom-control-label" for="cumplimientoImpactoEconomicoSi">Si</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            @if ($proyecto->obtenerRecomendacion($proyecto, 'impactoEconomico'))
                                                <input type="radio" name="cumplimientoImpactoEconomico" id="cumplimientoImpactoEconomicoNo" value="no" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'impactoEconomico')->cumplimiento == 'no' ? 'checked' : '' }}>
                                            @else
                                                <input type="radio" name="cumplimientoImpactoEconomico" id="cumplimientoImpactoEconomicoNo" value="no" class="custom-control-input">
                                            @endif
                                            <label class="custom-control-label" for="cumplimientoImpactoEconomicoNo">No</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endisset
                @isset($proyecto->impactoTecnologico)
                    <div class="datos-planeacion shadow p-4">
                        <div class="col-md-12">
                            <div class="row">
                                <label class="col-md-3 col-form-label text-md-left" for="impactoTecnologico"><strong>Impacto tecnológico</strong></label>
                                <div class="col-md-7">
                                    <p class="text-justify">{{ $proyecto->impactoTecnologico }}</p>
                                </div>
                            </div>
                            <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                <label class="col-md-3" for="recomendacion-impactoTecnologico">Recomendación</label>
                                <div class="col-md-7">
                                    <textarea id="recomendacion-impactoTecnologico" name="recomendacionImpactoTecnologico" rows="6" cols="80" class="form-control">{{ $proyecto->obtenerRecomendacion($proyecto, 'impactoTecnologico') != null ? $proyecto->obtenerRecomendacion($proyecto, 'impactoTecnologico')->recomendacion : '' }}</textarea>
                                </div>
                            </div>

                            @if ($proyecto->modificado)
                                <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                    <label class="col-md-3" for="cumplimiento-impactoTecnologico">
                                        ¿Cumple?
                                        <div id="impactoTecnologico" class="text-success"></div>
                                    </label>
                                    <div class="col-md-7">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            @if ($proyecto->obtenerRecomendacion($proyecto, 'impactoTecnologico'))
                                                <input type="radio" name="cumplimientoImpactoTecnologico" id="cumplimientoImpactoTecnologicoSi" value="si" class="custom-control-input" {{$proyecto->obtenerRecomendacion($proyecto, 'impactoTecnologico')->cumplimiento == 'si' ? 'checked' : '' }}>
                                            @else
                                                <input type="radio" name="cumplimientoImpactoTecnologico" id="cumplimientoImpactoTecnologicoSi" value="si" class="custom-control-input">
                                            @endif
                                            <label class="custom-control-label" for="cumplimientoImpactoTecnologicoSi">Si</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            @if ($proyecto->obtenerRecomendacion($proyecto, 'impactoTecnologico'))
                                                <input type="radio" name="cumplimientoImpactoTecnologico" id="cumplimientoImpactoTecnologicoNo" value="no" class="custom-control-input" {{$proyecto->obtenerRecomendacion($proyecto, 'impactoTecnologico')->cumplimiento == 'no' ? 'checked' : '' }}>
                                            @else
                                                <input type="radio" name="cumplimientoImpactoTecnologico" id="cumplimientoImpactoTecnologicoNo" value="no" class="custom-control-input">
                                            @endif
                                            <label class="custom-control-label" for="cumplimientoImpactoTecnologicoNo">No</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endisset
                @isset($proyecto->impactoAmbiental)

                    <div class="datos-planeacion shadow p-4">
                        <div class="col-md-12">
                            <div class="row">
                                <label class="col-md-3 col-form-label text-md-left" for="impactoAmbiental"><strong>Impacto ambiental</strong></label>
                                <div class="col-md-7">
                                    <p class="text-justify">{{ $proyecto->impactoAmbiental }}</p>
                                </div>
                            </div>
                            <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                <label class="col-md-3" for="recomendacion-impactoAmbiental">Recomendación</label>
                                <div class="col-md-7">
                                    <textarea id="recomendacion-impactoAmbiental" name="recomendacionImpactoAmbiental" rows="6" cols="80" class="form-control">{{$proyecto->obtenerRecomendacion($proyecto, 'impactoAmbiental') != null ? $proyecto->obtenerRecomendacion($proyecto, 'impactoAmbiental')->recomendacion : '' }}</textarea>
                                </div>
                            </div>

                            @if ($proyecto->modificado)
                                <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                    <label class="col-md-3" for="cumplimiento-impactoAmbiental">
                                        ¿Cumple?
                                        <div id="impactoAmbiental" class="text-success"></div>
                                    </label>
                                    <div class="col-md-7">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            @if ($proyecto->obtenerRecomendacion($proyecto, 'impactoAmbiental'))
                                                <input type="radio" name="cumplimientoImpactoAmbiental" id="cumplimientoImpactoAmbientalSi" value="si" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'impactoAmbiental')->cumplimiento == 'si' ? 'checked' : '' }}>
                                            @else
                                                <input type="radio" name="cumplimientoImpactoAmbiental" id="cumplimientoImpactoAmbientalSi" value="si" class="custom-control-input">
                                            @endif
                                            <label class="custom-control-label" for="cumplimientoImpactoAmbientalSi">Si</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            @if ($proyecto->obtenerRecomendacion($proyecto, 'impactoAmbiental'))
                                                <input type="radio" name="cumplimientoImpactoAmbiental" id="cumplimientoImpactoAmbientalNo" value="no" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'impactoAmbiental')->cumplimiento == 'no' ? 'checked' : '' }}>
                                            @else
                                                <input type="radio" name="cumplimientoImpactoAmbiental" id="cumplimientoImpactoAmbientalNo" value="no" class="custom-control-input">
                                            @endif
                                            <label class="custom-control-label" for="cumplimientoImpactoAmbientalNo">No</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endisset

                {{-- Postconficto  --}}
                @if ($proyecto->aplicacionPosconflicto == 'si')
                    <div class="datos-planeacion shadow p-4">
                        <div class="col-md-12">
                            <div class="row pt-4 pb-4">
                                <div class="col-md-3">
                                    <strong>Municipios a impactar</strong>
                                </div>
                                <div class="col-md-7">
                                    <p class="text-justify">
                                        {{ $proyecto->municipiosAImpactar }}
                                    </p>
                                </div>
                            </div>
                            <div class="row pt-4 pb-4">
                                <div class="col-md-3">
                                    <strong>Descripción de la estratégia</strong>
                                </div>
                                <div class="col-md-7">
                                    <p class="text-justify">
                                        {{ $proyecto->descripcionEstrategia }}
                                    </p>
                                </div>
                            </div>
                            <div class="row pt-4 pb-4">
                                <div class="col-md-3">
                                    <strong>Recursos posconflicto</strong>
                                </div>
                                <div class="col-md-7">
                                    <p class="text-justify">
                                        $ {{ number_format($proyecto->recursosPosconflicto, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                            <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                <label class="col-md-3" for="recomendacion-posconflicto">Recomendación</label>
                                <div class="col-md-7">
                                    <textarea id="recomendacion-posconflicto" name="recomendacionPosconflicto" rows="6" cols="80" class="form-control">{{ $proyecto->obtenerRecomendacion($proyecto, 'posconflicto') != null ? $proyecto->obtenerRecomendacion($proyecto, 'posconflicto')->recomendacion : '' }}</textarea>
                                </div>
                            </div>

                            @if ($proyecto->modificado)
                                <div class="row mt-5 mb-5 pt-4 recomendacion-evaluacion">
                                    <label class="col-md-3" for="cumplimiento-posconflicto">
                                        ¿Cumple?
                                        <div id="posconflicto" class="text-success"></div>
                                    </label>
                                    <div class="col-md-7">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            @if ($proyecto->obtenerRecomendacion($proyecto, 'posconflicto'))
                                                <input type="radio" name="cumplimientoPosconflicto" id="cumplimientoPosconflictoSi" value="si" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'posconflicto')->cumplimiento == 'si' ? 'checked' : '' }}>
                                            @else
                                                <input type="radio" name="cumplimientoPosconflicto" id="cumplimientoPosconflictoSi" value="si" class="custom-control-input">
                                            @endif
                                            <label class="custom-control-label" for="cumplimientoPosconflictoSi">Si</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            @if ($proyecto->obtenerRecomendacion($proyecto, 'posconflicto'))
                                                <input type="radio" name="cumplimientoPosconflicto" id="cumplimientoPosconflictoNo" value="no" class="custom-control-input" {{ $proyecto->obtenerRecomendacion($proyecto, 'posconflicto')->cumplimiento == 'no' ? 'checked' : '' }}>
                                            @else
                                                <input type="radio" name="cumplimientoPosconflicto" id="cumplimientoPosconflictoNo" value="no" class="custom-control-input">
                                            @endif
                                            <label class="custom-control-label" for="cumplimientoPosconflictoNo">No</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <div class="datos-planeacion shadow p-4">
                    <div class="col-md-9 offset-md-3">
                        {{-- <a class="btn btn-primary" href="{{ route('evaluacion.evaluarResultados', $proyecto->id) }}">Guardar y continuar</a> --}}
                        <button type="submit" class="btn btn-primary">Guardar y continuar</button>
                    </div>
                </div>
            </form>

        </div>

    </div>
@endsection
