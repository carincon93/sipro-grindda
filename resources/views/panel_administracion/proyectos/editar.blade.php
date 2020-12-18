@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <form action="{{ route('proyectos.update', $proyecto->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left">Tipo de proyecto <span class="text-danger">*</span></label>
                        @if ($proyecto->tipoProyecto != 'Proyecto formativo')
                            <div class="col-md-9">
                                <div class="custom-control custom-radio">
                                    <input id="{{ $proyecto->tipoProyecto }}" type="radio" name="tipoProyecto" value="{{ $proyecto->tipoProyecto }}" class="custom-control-input" checked required>
                                    <label class="custom-control-label" for="{{ $proyecto->tipoProyecto }}">
                                        {{ $proyecto->tipoProyecto }}
                                    </label>
                                </div>
                                @can ('proyecto-investigacion')
                                    @if ($proyecto->tipoProyecto != 'Proyecto de investigación')
                                        <div class="custom-control custom-radio">
                                            <input id="proyectoInvestigacion" type="radio" name="tipoProyecto" value="Proyecto de investigación" class="custom-control-input" {{ $proyecto->tipoProyecto == 'Proyecto de investigación' ? 'checked' : '' }} required>
                                            <label class="custom-control-label proyectoInvestigacion" for="proyectoInvestigacion">
                                                Proyecto de investigación
                                            </label>
                                        </div>
                                    @endif
                                @endcan
                                @can ('proyecto-innovacion')
                                    @if ($proyecto->tipoProyecto != 'Proyecto de innovación')
                                        <div class="custom-control custom-radio">
                                            <input id="proyectoInnovacion" type="radio" name="tipoProyecto" value="Proyecto de innovación" class="custom-control-input" {{ $proyecto->tipoProyecto == 'Proyecto de innovación' ? 'checked' : '' }} required>
                                            <label class="form-check-label custom-control-label" for="proyectoInnovacion">
                                                Proyecto de innovación
                                            </label>
                                        </div>
                                    @endif
                                @endcan
                                @can ('proyecto-modernizacion')
                                    @if ($proyecto->tipoProyecto != 'Proyecto de modernización')
                                        <div class="custom-control custom-radio">
                                            <input id="proyectoModernizacion" type="radio" name="tipoProyecto" value="Proyecto de modernización" class="custom-control-input" {{ $proyecto->tipoProyecto == 'Proyecto de modernización' ? 'checked' : '' }} required>
                                            <label class="form-check-label custom-control-label" for="proyectoModernizacion">
                                                Proyecto de modernización
                                            </label>
                                        </div>
                                    @endif
                                @endcan
                                @can ('proyecto-divulgacion')
                                    @if ($proyecto->tipoProyecto != 'Proyecto de divulgación')
                                        <div class="custom-control custom-radio">
                                            <input id="proyectoDivulgacion" type="radio" name="tipoProyecto" value="Proyecto de divulgación" class="custom-control-input" {{ $proyecto->tipoProyecto == 'Proyecto de divulgación' ? 'checked' : '' }} required>
                                            <label class="form-check-label custom-control-label" for="proyectoDivulgacion">
                                                Proyecto de divulgación
                                            </label>
                                        </div>
                                    @endif
                                @endcan
                                @can ('proyecto-laboratorios')
                                    @if ($proyecto->tipoProyecto != 'Proyecto para fortalecimiento de laboratorios')
                                        <div class="custom-control custom-radio">
                                            <input id="proyectoLaboratorios" type="radio" name="tipoProyecto" value="Proyecto para fortalecimiento de laboratorios" class="custom-control-input" {{ $proyecto->tipoProyecto == 'Proyecto para fortalecimiento de laboratorios' ? 'checked' : '' }} required>
                                            <label class="form-check-label custom-control-label" for="proyectoLaboratorios">
                                                Proyecto para fortalecimiento de laboratorios
                                            </label>
                                        </div>
                                    @endif
                                @endcan
                                @if ($errors->has('tipoProyecto'))
                                    <span class="invalid-feedback d-block">
                                        <strong>{{ $errors->first('tipoProyecto') }}</strong>
                                    </span>
                                @endif
                            </div>
                        @else
                            @can ('proyecto-formativo')
                                <div class="custom-control custom-radio">
                                    <input id="proyectoFormativo" type="radio" name="tipoProyecto" value="Proyecto formativo" class="custom-control-input" {{ $proyecto->tipoProyecto == 'Proyecto formativo' ? 'checked' : '' }} required>
                                    <label class="custom-control-label proyectoFormativo" for="proyectoFormativo">
                                        Proyecto formativo
                                    </label>
                                </div>
                            @endcan
                        @endif
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left">Líneas de investigación <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            @foreach ($lineasInvestigacion as $key => $lineaInvestigacion)
                                <div class="custom-control custom-checkbox">
                                    @if (is_array(old('lineasInvestigacion')))
                                        <input id="lineasInvestigacion{{ $key }}" class="custom-control-input" type="checkbox" name="lineasInvestigacion[]" {{ $proyecto->lineasInvestigacion->contains($lineaInvestigacion) == true ? 'checked' : '' }} value="{{ $lineaInvestigacion->id }}" {{ old('lineasInvestigacion') == in_array($lineaInvestigacion->id, old('lineasInvestigacion')) ? 'checked' : '' }}>
                                    @else
                                        <input id="lineasInvestigacion{{ $key }}" class="custom-control-input" type="checkbox" name="lineasInvestigacion[]" {{ $proyecto->lineasInvestigacion->contains($lineaInvestigacion) == true ? 'checked' : '' }} value="{{ $lineaInvestigacion->id }}">
                                    @endif
                                    <label class="custom-control-label" for="lineasInvestigacion{{ $key }}">
                                        {{ $lineaInvestigacion->nombre }}
                                    </label>
                                </div>
                            @endforeach

                            @if ($errors->has('lineasInvestigacion'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('lineasInvestigacion') }}</strong>
                                </span>
                            @endif

                            {{-- @if ($proyecto->obtenerRecomendacion($proyecto, 'programasFormacion'))
                                @if ($proyecto->obtenerRecomendacion($proyecto, 'programasFormacion')->recomendacion != null)
                                    <div class="alert alert-danger mt-2" role="alert">
                                        <p class="m-0"><strong>Recomendación: </strong>{{ $proyecto->obtenerRecomendacion($proyecto, 'programasFormacion')->recomendacion }}</p>
                                        <p class="m-0"><strong>Última fecha de evaluación: </strong> <span class="fecha">{{ $proyecto->obtenerRecomendacion($proyecto, 'programasFormacion')->updated_at }}</span></p>
                                    </div>
                                @endif
                            @endif --}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="tituloProyecto">Título del proyecto <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input id="tituloProyecto" type="text" name="titulo" value="{{ $proyecto->titulo }}" class="form-control{{ $errors->has('titulo') ? ' is-invalid' : '' }}" autocomplete="off" required>
                            @if ($errors->has('titulo'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('titulo') }}</strong>
                                </span>
                            @endif

                            @if ($proyecto->obtenerRecomendacion($proyecto, 'titulo'))
                                @if ($proyecto->obtenerRecomendacion($proyecto, 'titulo')->recomendacion != null)
                                    <div class="alert alert-danger mt-2" role="alert">
                                        <p class="m-0"><strong>Recomendación: </strong>{{ $proyecto->obtenerRecomendacion($proyecto, 'titulo')->recomendacion }}</p>
                                        <p class="m-0"><strong>Última fecha de evaluación: </strong><span class="fecha">{{ $proyecto->obtenerRecomendacion($proyecto, 'titulo')->updated_at }}</span></p>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left">Coautores del proyecto</label>
                        <div class="col-md-9">
                            <p class="hint-text small">Busca al coautor por el número de documento</p>
                            <buscar-coautor :userdocumento="{{ auth()->user()->numeroDocumento }}" :userid="{{ auth()->user()->id }}" :coautoresguardados="{{ $proyecto->autores }}"></buscar-coautor>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="areaConocimiento1">#1 Área de conocimiento <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <select id="areaConocimiento1" name="areaConocimiento1" class="form-control{{ $errors->has('areaConocimiento1') ? ' is-invalid' : '' }}" required>
                                <option value="">Seleccione una área de conocimiento</option>
                                @foreach ($areasConocimiento as $areaConocimiento)
                                    <option value="{{ $areaConocimiento->nombre }}" {{ $proyecto->areaConocimiento1 == $areaConocimiento->nombre ? 'selected' : '' }}>{{ $areaConocimiento->nombre }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('areaConocimiento1'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('areaConocimiento1') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="areaConocimiento2">#2 Área de conocimiento</label>
                        <div class="col-md-9">
                            <select id="areaConocimiento2" name="areaConocimiento2" class="form-control{{ $errors->has('areaConocimiento2') ? ' is-invalid' : '' }}">
                                <option value="">Seleccione una área de conocimiento</option>
                                @foreach ($areasConocimiento as $areaConocimiento)
                                    <option value="{{ $areaConocimiento->nombre }}" {{ $proyecto->areaConocimiento2 == $areaConocimiento->nombre ? 'selected' : '' }}>{{ $areaConocimiento->nombre }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('areaConocimiento2'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('areaConocimiento1') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row fechas">
                        <label class="col-md-3 col-form-label text-md-left" for="fechaInicioProyecto">Fechas <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="col-form-label text-md-left" for="fechaFinProyecto">Fecha de inicio del proyecto</label>
                                    <input id="fechaInicioProyecto" type="date" name="fechaInicioProyecto" value="{{ $proyecto->fechaInicioProyecto }}" class="form-control{{ $errors->has('fechaInicioProyecto') ? ' is-invalid' : '' }}" required>
                                    @if ($errors->has('fechaInicioProyecto'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('fechaInicioProyecto') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-5">
                                    <label class="col-form-label text-md-left" for="fechaFinProyecto">Fecha de fin del proyecto</label>
                                    <input id="fechaFinProyecto" type="date" name="fechaFinProyecto" value="{{ $proyecto->fechaFinProyecto }}" class="form-control{{ $errors->has('fechaFinProyecto') ? ' is-invalid' : '' }}" required>
                                    @if ($errors->has('fechaFinProyecto'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('fechaFinProyecto') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="antecedentesJustificacionProyecto">Antecedentes y justificación del proyecto <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <textarea id="antecedentesJustificacionProyecto" name="antecedentesJustificacionProyecto" rows="8" cols="80" class="form-control{{ $errors->has('antecedentesJustificacionProyecto') ? ' is-invalid' : '' }}" required>{{ $proyecto->antecedentesJustificacionProyecto }}</textarea>
                            @if ($errors->has('antecedentesJustificacionProyecto'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('antecedentesJustificacionProyecto') }}</strong>
                                </span>
                            @endif

                            @if ($proyecto->obtenerRecomendacion($proyecto, 'antecedentesJustificacionProyecto'))
                                @if ($proyecto->obtenerRecomendacion($proyecto, 'antecedentesJustificacionProyecto')->recomendacion != null)
                                    <div class="alert alert-danger mt-2" role="alert">
                                        <p class="m-0"><strong>Recomendación: </strong>{{ $proyecto->obtenerRecomendacion($proyecto, 'antecedentesJustificacionProyecto')->recomendacion }}</p>
                                        <p class="m-0"><strong>Última fecha de evaluación: </strong><span class="fecha">{{ $proyecto->obtenerRecomendacion($proyecto, 'antecedentesJustificacionProyecto')->updated_at }}</span></p>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="planteamientoProblema">Planteamiento del problema <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <textarea id="planteamientoProblema" name="planteamientoProblema" rows="8" cols="80" class="form-control{{ $errors->has('planteamientoProblema') ? ' is-invalid' : '' }}" required>{{ $proyecto->planteamientoProblema }}</textarea>
                            @if ($errors->has('planteamientoProblema'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('planteamientoProblema') }}</strong>
                                </span>
                            @endif

                            @if ($proyecto->obtenerRecomendacion($proyecto, 'problema'))
                                @if ($proyecto->obtenerRecomendacion($proyecto, 'problema')->recomendacion != null)
                                    <div class="alert alert-danger mt-2" role="alert">
                                        <p class="m-0"><strong>Recomendación: </strong>{{ $proyecto->obtenerRecomendacion($proyecto, 'problema')->recomendacion }}</p>
                                        <p class="m-0"><strong>Última fecha de evaluación: </strong><span class="fecha">{{ $proyecto->obtenerRecomendacion($proyecto, 'problema')->updated_at }}</span></p>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="metodologia">Metodología <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <textarea id="metodologia" name="metodologia" rows="8" cols="80" class="form-control{{ $errors->has('metodologia') ? ' is-invalid' : '' }}" required>{{ $proyecto->metodologia }}</textarea>
                            @if ($errors->has('metodologia'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('metodologia') }}</strong>
                                </span>
                            @endif

                            @if ($proyecto->obtenerRecomendacion($proyecto, 'metodologia'))
                                @if ($proyecto->obtenerRecomendacion($proyecto, 'metodologia')->recomendacion != null)
                                    <div class="alert alert-danger mt-2" role="alert">
                                        <p class="m-0"><strong>Recomendación: </strong>{{ $proyecto->obtenerRecomendacion($proyecto, 'metodologia')->recomendacion }}</p>
                                        <p class="m-0"><strong>Última fecha de evaluación: </strong><span class="fecha">{{ $proyecto->obtenerRecomendacion($proyecto, 'metodologia')->updated_at }}</span></p>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="objetivoGeneral">Objetivo general <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <textarea id="objetivoGeneral" name="objetivoGeneral" class="form-control{{ $errors->has('objetivoGeneral') ? ' is-invalid' : '' }}" rows="8" cols="80" required>{{ $proyecto->objetivoGeneral }}</textarea>
                            @if ($errors->has('objetivoGeneral'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('objetivoGeneral') }}</strong>
                                </span>
                            @endif

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
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-left" for="objetivoEspecifico{{ $key + 1 }}">Objetivo específico Nro. {{ $key + 1 }} <span class="text-danger">*</span><div id="especifico{{ $objetivoEspecifico->id }}"></div></label>
                            <div class="col-md-9">
                                <input type="hidden" name="idObjetivoEspecifico[]" value="{{ $objetivoEspecifico->id }}">
                                <textarea id="objetivoEspecifico{{ $key + 1 }}" name="objetivoEspecifico[]" class="form-control{{ $errors->has('objetivoEspecifico.'.$key) ? ' is-invalid' : '' }} objetivoEspecifico" rows="8" cols="80" required>{{ $objetivoEspecifico->descripcion }}</textarea>
                                @if ($errors->has('objetivoEspecifico.'.$key))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('objetivoEspecifico.'.$key) }}</strong>
                                    </span>
                                @endif

                                @if ($proyecto->obtenerRecomendacion($proyecto, 'objetivoEspecifico'.($key + 1)))
                                    @if ($proyecto->obtenerRecomendacion($proyecto, 'objetivoEspecifico'.($key + 1))->recomendacion != null)
                                        <div class="alert alert-danger mt-2" role="alert">
                                            <p class="m-0"><strong>Recomendación: </strong>{{ $proyecto->obtenerRecomendacion($proyecto, 'objetivoEspecifico'.($key + 1))->recomendacion }}</p>
                                            <p class="m-0"><strong>Última fecha de evaluación: </strong><span class="fecha">{{ $proyecto->obtenerRecomendacion($proyecto, 'objetivoEspecifico'.($key + 1))->updated_at }}</span></p>
                                        </div>
                                    @endif
                                @endif

                            </div>
                        </div>
                    @endforeach

                    @if ($proyecto->objetivosEspecificos()->count() == 3)
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-left">¿Desea agregar el objetivo específico Nro. 4?</label>
                                <div class="col-md-9">
                                <div class="custom-control custom-radio">
                                    <input id="objetivoEspecifico4Si" type="radio" name="preguntaObjetivoEspecifico" value="true" class="custom-control-input" v-model="objetivoEspecifico4">
                                    <label class="custom-control-label objetivoEspecifico4Si" for="objetivoEspecifico4Si">
                                        Si
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="objetivoEspecifico4No" type="radio" name="preguntaObjetivoEspecifico" value="false" class="custom-control-input" v-model="objetivoEspecifico4">
                                    <label class="custom-control-label objetivoEspecifico4No" for="objetivoEspecifico4No">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" v-if="objetivoEspecifico4 == 'true'">
                            <label class="col-md-3 col-form-label text-md-left" for="objetivoEspecifico4">Objetivo específico Nro. 4 <span class="text-danger">*</span><div id="especifico{{ $objetivoEspecifico->id }}"></div></label>
                            <div class="col-md-9">
                                <textarea id="objetivoEspecifico4" name="objetivoEspecifico4" class="form-control{{ $errors->has('objetivoEspecifico.3') ? ' is-invalid' : '' }} objetivoEspecifico" rows="8" cols="80"  required></textarea>
                                @if ($errors->has('objetivoEspecifico.3'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('objetivoEspecifico.3') }}</strong>
                                    </span>
                                @endif

                                @if ($proyecto->obtenerRecomendacion($proyecto, 'objetivoEspecifico4'))
                                    @if ($proyecto->obtenerRecomendacion($proyecto, 'objetivoEspecifico4')->recomendacion != null)
                                        <div class="alert alert-danger mt-2" role="alert">
                                            <p class="m-0"><strong>Recomendación: </strong>{{ $proyecto->obtenerRecomendacion($proyecto, 'objetivoEspecifico4')->recomendacion }}</p>
                                            <p class="m-0"><strong>Última fecha de evaluación: </strong> <span class="fecha">{{ $proyecto->obtenerRecomendacion($proyecto, 'objetivoEspecifico4')->updated_at }}</span></p>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- @can ('info-grupo-investigacion') --}}
                        @if ($proyecto->tipoProyecto != 'Proyecto formativo')
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-left" for="grupoInvestigacion">Grupo de investigación <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select id="grupoInvestigacion" class="form-control{{ $errors->has('grupoInvestigacion') ? ' is-invalid' : '' }}" name="grupoInvestigacion" required>
                                        @foreach ($gruposInvestigacion as $key => $grupoInvestigacion)
                                            <option value="{{ $grupoInvestigacion->id }}" {{ $proyecto->grupoInvestigacion->id == $grupoInvestigacion->id  ? 'selected' : '' }}>{{ $grupoInvestigacion->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('grupoInvestigacion'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('grupoInvestigacion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-left" for="codigoGruplac">Código Gruplac <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select id="codigoGruplac" class="form-control{{ $errors->has('codigoGruplac') ? ' is-invalid' : '' }}" name="codigoGruplac" required>
                                        @foreach ($gruplac as $key => $gruplac)
                                            <option value="{{ $gruplac->codigo }}" {{ $proyecto->codigoGruplac == $gruplac->codigo  ? 'selected' : '' }}>{{ $gruplac->codigo }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('codigoGruplac'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('codigoGruplac') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        @endif
                    {{-- @endcan --}}

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left">Semilleros beneficiados <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            @foreach ($semilleros as $key => $semillero)
                                <div class="custom-control custom-checkbox">
                                    @if (is_array(old('semillero')))
                                        <input id="semillero{{ $key }}" class="custom-control-input" type="checkbox" name="semillero[]" {{ $proyecto->semilleros->contains($semillero) == true ? 'checked' : '' }} value="{{ $semillero->id }}" {{ old('semillero') == in_array($semillero->id, old('semillero')) ? 'checked' : '' }}>
                                    @else
                                        <input id="semillero{{ $key }}" class="custom-control-input" type="checkbox" name="semillero[]" {{ $proyecto->semilleros->contains($semillero) == true ? 'checked' : '' }} value="{{ $semillero->id }}">
                                    @endif
                                    <label class="custom-control-label" for="semillero{{ $key }}">
                                        <strong>{{ $semillero->nombre }}</strong>
                                        {{-- <span data-toggle="tooltip" data-placement="right" title="{{ $semillero->descripcion }}"><i class="fas fa-question-circle"></i></span> --}}
                                        {{ $semillero->descripcion }}
                                    </label>
                                </div>
                            @endforeach
                            @if ($errors->has('semillero'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('semillero') }}</strong>
                                </span>
                            @endif

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

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left">Programas de formación beneficiados</label>
                        <div class="col-md-9">
                            @foreach ($programasFormacion as $key => $programaFormacion)
                                <div class="custom-control custom-checkbox">
                                    @if (is_array(old('programaFormacion')))
                                        <input id="programaFormacion{{ $key }}" class="custom-control-input" type="checkbox" name="programaFormacion[]" {{ $proyecto->programasFormacion->contains($programaFormacion) == true ? 'checked' : '' }} value="{{ $programaFormacion->id }}" {{ old('programaFormacion') == in_array($programaFormacion->id, old('programaFormacion')) ? 'checked' : '' }}>
                                    @else
                                        <input id="programaFormacion{{ $key }}" class="custom-control-input" type="checkbox" name="programaFormacion[]" {{ $proyecto->programasFormacion->contains($programaFormacion) == true ? 'checked' : '' }} value="{{ $programaFormacion->id }}">
                                    @endif
                                    <label class="custom-control-label" for="programaFormacion{{ $key }}">
                                        {{ $programaFormacion->nombre }}
                                    </label>
                                </div>
                            @endforeach

                            @if ($errors->has('programaFormacion'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('programaFormacion') }}</strong>
                                </span>
                            @endif

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

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="impactoSocial">Impacto social</label>
                        <div class="col-md-9">
                            <textarea id="impactoSocial" name="impactoSocial" rows="8" cols="80" class="form-control{{ $errors->has('impactoSocial') ? ' is-invalid' : '' }}">{{ $proyecto->impactoSocial }}</textarea>
                            @if ($errors->has('impactoSocial'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('impactoSocial') }}</strong>
                                </span>
                            @endif

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

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="impactoEconomico">Impacto económico</label>
                        <div class="col-md-9">
                            <textarea id="impactoEconomico" name="impactoEconomico" rows="8" cols="80" class="form-control{{ $errors->has('impactoEconomico') ? ' is-invalid' : '' }}">{{ $proyecto->impactoEconomico }}</textarea>
                            @if ($errors->has('impactoEconomico'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('impactoEconomico') }}</strong>
                                </span>
                            @endif

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

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="impactoTecnologico">Impacto tecnológico</label>
                        <div class="col-md-9">
                            <textarea id="impactoTecnologico" name="impactoTecnologico" rows="8" cols="80" class="form-control{{ $errors->has('impactoTecnologico') ? ' is-invalid' : '' }}">{{ $proyecto->impactoTecnologico }}</textarea>
                            @if ($errors->has('impactoTecnologico'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('impactoTecnologico') }}</strong>
                                </span>
                            @endif

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

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="impactoAmbiental">Impacto ambiental</label>
                        <div class="col-md-9">
                            <textarea id="impactoAmbiental" name="impactoAmbiental" rows="8" cols="80" class="form-control{{ $errors->has('impactoAmbiental') ? ' is-invalid' : '' }}">{{ $proyecto->impactoAmbiental }}</textarea>
                            @if ($errors->has('impactoAmbiental'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('impactoAmbiental') }}</strong>
                                </span>
                            @endif

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
                        <div class="form-group row">
                            <label class="col-md-3" for="municipiosAImpactar">Municipios a impactar <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input id="municipiosAImpactar" type="text" name="municipiosAImpactar" value="{{ $proyecto->municipiosAImpactar }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3" for="descripcionEstrategia">Descripción de la estratégia <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <textarea id="descripcionEstrategia" name="descripcionEstrategia" rows="8" cols="80" class="form-control" required>{{ $proyecto->descripcionEstrategia }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3" for="recursosPosconflicto">Recursos posconflicto ($COP) <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input id="recursosPosconflicto" type="number" pattern="[0-9]" pattern="[0-9]" min="0" max="9999999999" name="recursosPosconflicto" value="{{ $proyecto->recursosPosconflicto }}" class="form-control" required>

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
                    @else
                        <posconflicto :errors="{{ $errors }}"></posconflicto>
                    @endif

                    <div class="p-4 row mb-0">
                        <div class="col-md-9 offset-md-3">
                            <button type="submit" name="button" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
