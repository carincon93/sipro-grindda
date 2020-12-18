@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <a href="{{ url()->previous() }}" class="btn btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>
                <a href="{{ route('resultados.show', [$proyecto->id, $proyecto->objetivosEspecificos->first()->id]) }}" class="btn btn-success d-inline-block mb-4"><i class="fas fa-external-link-alt"></i> Ir a la planeación</a>
                <div class="row border-bottom pt-2 pb-2">
                    <strong class="col-md-3 text-md-left" for="tituloProyecto">Título del proyecto</strong>
                    <div class="col-md-9">
                        <h1>{{ $proyecto->titulo }}</h1>

                        @if ($proyecto->obtenerRecomendacion($proyecto, 'titulo'))
                            @if ($proyecto->obtenerRecomendacion($proyecto, 'titulo')->recomendacion != null)
                                <div class="alert alert-danger mt-2" role="alert">
                                    <p class="m-0"><strong>Recomendación: </strong>{{ $proyecto->obtenerRecomendacion($proyecto, 'titulo')->recomendacion }}</p>
                                    <p class="m-0"><strong>Última fecha de evaluación: </strong> <span class="fecha">{{ $proyecto->obtenerRecomendacion($proyecto, 'titulo')->updated_at }}</span></p>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="row border-bottom pt-2 pb-2">
                    <strong class="col-md-3 text-md-left">Tipo de proyecto</strong>

                    <div class="col-md-9">
                        <p class="m-0">{{ $proyecto->tipoProyecto }}</p>
                    </div>
                </div>

                <div class="row border-bottom pt-2 pb-2">
                    <strong class="col-md-3 text-md-left">Líneas de investigación asociadas</strong>
                    <div class="col-md-9">
                        <ul>
                            @forelse ($proyecto->lineasInvestigacion as $key => $lineaInvestigacion)
                                <li>{{ $lineaInvestigacion->nombre }}</li>
                            @empty
                                <li>No hay líneas de investigación asociadas</li>
                            @endforelse
                        </ul>

                        @if ($proyecto->obtenerRecomendacion($proyecto, 'lineasInvestigacion'))
                            @if ($proyecto->obtenerRecomendacion($proyecto, 'lineasInvestigacion')->recomendacion != null)
                                <div class="alert alert-danger mt-2" role="alert">
                                    <p class="m-0"><strong>Recomendación: </strong>{{ $proyecto->obtenerRecomendacion($proyecto, 'lineasInvestigacion')->recomendacion }}</p>
                                    <p class="m-0"><strong>Última fecha de evaluación: </strong> <span class="fecha">{{ $proyecto->obtenerRecomendacion($proyecto, 'lineasInvestigacion')->updated_at }}</span></p>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="row border-bottom pt-2 pb-2">
                    <strong class="col-md-3 text-md-left">Autores y coautores del proyecto</strong>
                    <div class="col-md-9">
                        <ul>
                            @foreach ($proyecto->autores as $autor)
                                <li>{{ $autor->nombre }}</li>
                            @endforeach
                        </ul>

                    </div>
                </div>

                <div class="row border-bottom pt-2 pb-2">
                    <strong class="col-md-3 text-md-left" for="areaConocimiento1">#1 Área de conocimiento</strong>
                    <div class="col-md-9">
                        {{ $proyecto->areaConocimiento1 }}
                    </div>
                </div>

                <div class="row border-bottom pt-2 pb-2">
                    <strong class="col-md-3 text-md-left" for="areaConocimiento2">#2 Área de conocimiento</strong>
                    <div class="col-md-9">
                        {{ $proyecto->areaConocimiento2 }}
                    </div>
                </div>

                <div class="row border-bottom pt-2 pb-2">
                    <strong class="col-md-3 text-md-left">Fechas</strong>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong class="text-md-left" for="fechaFinProyecto">Fecha de inicio del proyecto</strong></p>
                                <span class="fecha">{{ $proyecto->fechaInicioProyecto }}</span>
                            </div>
                            <div class="col-md-5">
                                <p><strong class="text-md-left" for="fechaFinProyecto">Fecha de fin del proyecto</strong></p>
                                <span class="fecha">{{ $proyecto->fechaFinProyecto }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row border-bottom pt-2 pb-2">
                    <strong class="col-md-3 text-md-left" for="antecedentesJustificacionProyecto">Antecedentes y justificación del proyecto</strong>
                    <div class="col-md-9">
                        <p class="m-0 text-justify">{{ $proyecto->antecedentesJustificacionProyecto }}</p>

                        @if ($proyecto->obtenerRecomendacion($proyecto, 'antecedentesJustificacionProyecto'))
                            @if ($proyecto->obtenerRecomendacion($proyecto, 'antecedentesJustificacionProyecto')->recomendacion != null)
                                <div class="alert alert-danger mt-2" role="alert">
                                    <p class="m-0"><strong>Recomendación: </strong>{{ $proyecto->obtenerRecomendacion($proyecto, 'antecedentesJustificacionProyecto')->recomendacion }}</p>
                                    <p class="m-0"><strong>Última fecha de evaluación: </strong> <span class="fecha">{{ $proyecto->obtenerRecomendacion($proyecto, 'antecedentesJustificacionProyecto')->updated_at }}</span></p>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="row border-bottom pt-2 pb-2">
                    <strong class="col-md-3 text-md-left" for="planteamientoProblema">Planteamiento del problema</strong>
                    <div class="col-md-9">
                        <p class="m-0 text-justify">{{ $proyecto->planteamientoProblema }}</p>

                        @if ($proyecto->obtenerRecomendacion($proyecto, 'problema'))
                            @if ($proyecto->obtenerRecomendacion($proyecto, 'problema')->recomendacion != null)
                                <div class="alert alert-danger mt-2" role="alert">
                                    <p class="m-0"><strong>Recomendación: </strong>{{ $proyecto->obtenerRecomendacion($proyecto, 'problema')->recomendacion }}</p>
                                    <p class="m-0"><strong>Última fecha de evaluación: </strong> <span class="fecha">{{ $proyecto->obtenerRecomendacion($proyecto, 'problema')->updated_at }}</span></p>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="row border-bottom pt-2 pb-2">
                    <strong class="col-md-3 text-md-left" for="metodologia">Metodología</strong>
                    <div class="col-md-9">
                        <p class="m-0 text-justify">{{ $proyecto->metodologia }}</p>

                        @if ($proyecto->obtenerRecomendacion($proyecto, 'metodologia'))
                            @if ($proyecto->obtenerRecomendacion($proyecto, 'metodologia')->recomendacion != null)
                                <div class="alert alert-danger mt-2" role="alert">
                                    <p class="m-0"><strong>Recomendación: </strong>{{ $proyecto->obtenerRecomendacion($proyecto, 'metodologia')->recomendacion }}</p>
                                    <p class="m-0"><strong>Última fecha de evaluación: </strong> <span class="fecha">{{ $proyecto->obtenerRecomendacion($proyecto, 'metodologia')->updated_at }}</span></p>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="row border-bottom pt-2 pb-2">
                    <strong class="col-md-3 text-md-left" for="objetivoGeneral">Objetivo general</strong>
                    <div class="col-md-9">
                        <p class="m-0 text-justify">{{ $proyecto->objetivoGeneral }}</p>

                        @if ($proyecto->obtenerRecomendacion($proyecto, 'objetivoGeneral'))
                            @if ($proyecto->obtenerRecomendacion($proyecto, 'objetivoGeneral')->recomendacion != null)
                                <div class="alert alert-danger mt-2" role="alert">
                                    <p class="m-0"><strong>Recomendación: </strong>{{ $proyecto->obtenerRecomendacion($proyecto, 'objetivoGeneral')->recomendacion }}</p>
                                    <p class="m-0"><strong>Última fecha de evaluación: </strong> <span class="fecha">{{ $proyecto->obtenerRecomendacion($proyecto, 'objetivoGeneral')->updated_at }}</span></p>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>


                @foreach ($proyecto->objetivosEspecificos as $key => $objetivoEspecifico)
                    <div class="row border-bottom pt-2 pb-2">
                        <strong class="col-md-3 text-md-left" for="objetivoEspecifico{{ $key + 1 }}">Objetivo específico Nro. {{ $key + 1 }}</strong>
                        <div class="col-md-9">
                            <p class="m-0 text-justify">{{ $objetivoEspecifico->descripcion }}</p>

                            @if ($proyecto->obtenerRecomendacion($proyecto, 'objetivoEspecifico'.($key + 1)))
                                @if ($proyecto->obtenerRecomendacion($proyecto, 'objetivoEspecifico'.($key + 1))->recomendacion != null)
                                    <div class="alert alert-danger mt-2" role="alert">
                                        <p class="m-0"><strong>Recomendación: </strong>{{ $proyecto->obtenerRecomendacion($proyecto, 'objetivoEspecifico'.($key + 1))->recomendacion }}</p>
                                        <p class="m-0"><strong>Última fecha de evaluación: </strong> <span class="fecha">{{ $proyecto->obtenerRecomendacion($proyecto, 'objetivoEspecifico'.($key + 1))->updated_at }}</span></p>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach

                @can ('info-grupo-investigacion')
                    @isset($proyecto->grupoInvestigacion)
                        <div class="row border-bottom pt-2 pb-2">
                            <strong class="col-md-3 text-md-left" for="grupoInvestigacion">Grupo de investigación</strong>
                            <div class="col-md-9">
                                {{ $proyecto->grupoInvestigacion->nombre }}
                            </div>
                        </div>
                    @endisset

                    @isset($proyecto->codigoGruplac)
                        <div class="row border-bottom pt-2 pb-2">
                            <strong class="col-md-3 text-md-left" for="codigoGruplac">Código Gruplac</strong>
                            <div class="col-md-9">
                                {{ $proyecto->codigoGruplac }}
                            </div>
                        </div>
                    @endisset
                @endcan

                <div class="row border-bottom pt-2 pb-2">
                    <strong class="col-md-3 text-md-left">Semilleros beneficiados</strong>
                    <div class="col-md-9">
                        <ul>
                            @foreach ($proyecto->semilleros as $key => $semillero)
                                <li>{{ $semillero->nombre }}</li>
                            @endforeach
                        </ul>

                        @if ($proyecto->obtenerRecomendacion($proyecto, 'semilleros'))
                            @if ($proyecto->obtenerRecomendacion($proyecto, 'semilleros')->recomendacion != null)
                                <div class="alert alert-danger mt-2" role="alert">
                                    <p class="m-0"><strong>Recomendación: </strong>{{ $proyecto->obtenerRecomendacion($proyecto, 'semilleros')->recomendacion }}</p>
                                    <p class="m-0"><strong>Última fecha de evaluación: </strong> <span class="fecha">{{ $proyecto->obtenerRecomendacion($proyecto, 'semilleros')->updated_at }}</span></p>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="row border-bottom pt-2 pb-2">
                    <strong class="col-md-3 text-md-left">Programas de formación beneficiados</strong>
                    <div class="col-md-9">
                        <ul>
                            @foreach ($proyecto->programasFormacion as $key => $programaFormacion)
                                <li>{{ $programaFormacion->nombre }}</li>
                            @endforeach
                        </ul>

                        @if ($proyecto->obtenerRecomendacion($proyecto, 'programasFormacion'))
                            @if ($proyecto->obtenerRecomendacion($proyecto, 'programasFormacion')->recomendacion != null)
                                <div class="alert alert-danger mt-2" role="alert">
                                    <p class="m-0"><strong>Recomendación: </strong>{{ $proyecto->obtenerRecomendacion($proyecto, 'programasFormacion')->recomendacion }}</p>
                                    <p class="m-0"><strong>Última fecha de evaluación: </strong> <span class="fecha">{{ $proyecto->obtenerRecomendacion($proyecto, 'programasFormacion')->updated_at }}</span></p>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="row border-bottom pt-2 pb-2">
                    <strong class="col-md-3 text-md-left" for="impactoSocial">Impacto social</strong>
                    <div class="col-md-9">
                        <p class="m-0 text-justify">{{ $proyecto->impactoSocial }}</p>
                        @if ($proyecto->obtenerRecomendacion($proyecto, 'impactoSocial'))
                            @if ($proyecto->obtenerRecomendacion($proyecto, 'impactoSocial')->recomendacion != null)
                                <div class="alert alert-danger mt-2" role="alert">
                                    <p class="m-0"><strong>Recomendación: </strong>{{ $proyecto->obtenerRecomendacion($proyecto, 'impactoSocial')->recomendacion }}</p>
                                    <p class="m-0"><strong>Última fecha de evaluación: </strong> <span class="fecha">{{ $proyecto->obtenerRecomendacion($proyecto, 'impactoSocial')->updated_at }}</span></p>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="row border-bottom pt-2 pb-2">
                    <strong class="col-md-3 text-md-left" for="impactoEconomico">Impacto económico</strong>
                    <div class="col-md-9">
                        <p class="m-0 text-justify">{{ $proyecto->impactoEconomico }}</p>
                        @if ($proyecto->obtenerRecomendacion($proyecto, 'impactoEconomico'))
                            @if ($proyecto->obtenerRecomendacion($proyecto, 'impactoEconomico')->recomendacion != null)
                                <div class="alert alert-danger mt-2" role="alert">
                                    <p class="m-0"><strong>Recomendación: </strong>{{ $proyecto->obtenerRecomendacion($proyecto, 'impactoEconomico')->recomendacion }}</p>
                                    <p class="m-0"><strong>Última fecha de evaluación: </strong> <span class="fecha">{{ $proyecto->obtenerRecomendacion($proyecto, 'impactoEconomico')->updated_at }}</span></p>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="row border-bottom pt-2 pb-2">
                    <strong class="col-md-3 text-md-left" for="impactoTecnologico">Impacto tecnológico</strong>
                    <div class="col-md-9">
                        <p class="m-0 text-justify">{{ $proyecto->impactoTecnologico }}</p>

                        @if ($proyecto->obtenerRecomendacion($proyecto, 'impactoTecnologico'))
                            @if ($proyecto->obtenerRecomendacion($proyecto, 'impactoTecnologico')->recomendacion != null)
                                <div class="alert alert-danger mt-2" role="alert">
                                    <p class="m-0"><strong>Recomendación: </strong>{{ $proyecto->obtenerRecomendacion($proyecto, 'impactoTecnologico')->recomendacion }}</p>
                                    <p class="m-0"><strong>Última fecha de evaluación: </strong> <span class="fecha">{{ $proyecto->obtenerRecomendacion($proyecto, 'impactoTecnologico')->updated_at }}</span></p>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="row border-bottom pt-2 pb-2">
                    <strong class="col-md-3 text-md-left" for="impactoAmbiental">Impacto ambiental</strong>
                    <div class="col-md-9">
                        <p class="m-0 text-justify">{{ $proyecto->impactoAmbiental }}</p>

                        @if ($proyecto->obtenerRecomendacion($proyecto, 'impactoAmbiental'))
                            @if ($proyecto->obtenerRecomendacion($proyecto, 'impactoAmbiental')->recomendacion != null)
                                <div class="alert alert-danger mt-2" role="alert">
                                    <p class="m-0"><strong>Recomendación: </strong>{{ $proyecto->obtenerRecomendacion($proyecto, 'impactoAmbiental')->recomendacion }}</p>
                                    <p class="m-0"><strong>Última fecha de evaluación: </strong> <span class="fecha">{{ $proyecto->obtenerRecomendacion($proyecto, 'impactoAmbiental')->updated_at }}</span></p>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                @if ($proyecto->aplicacionPosconflicto == 'si')
                    <input type="hidden" name="aplicacionPosconflictoSi" id="posconflictoSi" value="si">
                    <div class="row border-bottom pt-2 pb-2">
                        <strong class="col-md-3" for="municipiosAImpactar">Municipios a impactar</strong>
                        <div class="col-md-9">
                            <p class="mb-0 text-capitalize">{{ $proyecto->municipiosAImpactar }}</p>
                        </div>
                    </div>
                    <div class="row border-bottom pt-2 pb-2">
                        <strong class="col-md-3" for="descripcionEstrategia">Descripción de la estratégia</strong>
                        <div class="col-md-9">
                            <p class="m-0 text-justify">{{ $proyecto->descripcionEstrategia }}</p>
                        </div>
                    </div>
                    <div class="row border-bottom pt-2 pb-2">
                        <strong class="col-md-3" for="recursosPosconflicto">Recursos posconflicto ($COP)</strong>
                        <div class="col-md-9">
                            <p class="mb-0">$ {{ number_format($proyecto->recursosPosconflicto, 0, ',', '.') }}</p>

                            @if ($proyecto->obtenerRecomendacion($proyecto, 'posconflicto'))
                                @if ($proyecto->obtenerRecomendacion($proyecto, 'posconflicto')->recomendacion != null)
                                    <div class="alert alert-danger mt-2" role="alert">
                                        <p class="m-0"><strong>Recomendación: </strong>{{ $proyecto->obtenerRecomendacion($proyecto, 'posconflicto')->recomendacion }}</p>
                                        <p class="m-0"><strong>Última fecha de evaluación: </strong> <span class="fecha">{{ $proyecto->obtenerRecomendacion($proyecto, 'posconflicto')->updated_at }}</span></p>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
