@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <form action="{{ route('proyectos.store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal" novalidate>
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left">Tipo de proyecto <span class="text-danger">*</span></label>

                        <div class="col-md-9">
                            @can ('proyecto-formativo')
                                <div class="custom-control custom-radio">
                                    <input id="proyectoFormativo" type="radio" name="tipoProyecto" value="Proyecto formativo" class="custom-control-input" {{ old('tipoProyecto') == 'Proyecto formativo' ? 'checked' : '' }} v-model="tipoProyecto" required>
                                    <label class="custom-control-label proyectoFormativo" for="proyectoFormativo">
                                        Proyecto formativo
                                    </label>
                                </div>
                            @endcan
                            @can ('proyecto-investigacion')
                                <div class="custom-control custom-radio">
                                    <input id="proyectoInvestigacion" type="radio" name="tipoProyecto" value="Proyecto de investigación" class="custom-control-input" {{ old('tipoProyecto') == 'Proyecto de investigación' ? 'checked' : '' }} v-model="tipoProyecto" required>
                                    <label class="custom-control-label proyectoInvestigacion" for="proyectoInvestigacion">
                                        Proyecto de investigación
                                    </label>
                                </div>
                            @endcan
                            @can ('proyecto-innovacion')
                                <div class="custom-control custom-radio">
                                    <input id="proyectoInnovacion" type="radio" name="tipoProyecto" value="Proyecto de innovación" class="custom-control-input" {{ old('tipoProyecto') == 'Proyecto de innovación' ? 'checked' : '' }} v-model="tipoProyecto" required>
                                    <label class="form-check-label custom-control-label" for="proyectoInnovacion">
                                        Proyecto de innovación
                                    </label>
                                </div>
                            @endcan
                            @can ('proyecto-modernizacion')
                                <div class="custom-control custom-radio">
                                    <input id="proyectoModernizacion" type="radio" name="tipoProyecto" value="Proyecto de modernización" class="custom-control-input" {{ old('tipoProyecto') == 'Proyecto de modernización' ? 'checked' : '' }} v-model="tipoProyecto" required>
                                    <label class="form-check-label custom-control-label" for="proyectoModernizacion">
                                        Proyecto de modernización
                                    </label>
                                </div>
                            @endcan
                            @can ('proyecto-divulgacion')
                                <div class="custom-control custom-radio">
                                    <input id="proyectoDivulgacion" type="radio" name="tipoProyecto" value="Proyecto de divulgación" class="custom-control-input" {{ old('tipoProyecto') == 'Proyecto de divulgación' ? 'checked' : '' }} v-model="tipoProyecto" required>
                                    <label class="form-check-label custom-control-label" for="proyectoDivulgacion">
                                        Proyecto de divulgación
                                    </label>
                                </div>
                            @endcan
                            @can ('proyecto-laboratorios')
                                <div class="custom-control custom-radio">
                                    <input id="proyectoLaboratorios" type="radio" name="tipoProyecto" value="Proyecto para fortalecimiento de laboratorios" class="custom-control-input" {{ old('tipoProyecto') == 'Proyecto para fortalecimiento de laboratorios' ? 'checked' : '' }} v-model="tipoProyecto" required>
                                    <label class="form-check-label custom-control-label" for="proyectoLaboratorios">
                                        Proyecto para fortalecimiento de laboratorios
                                    </label>
                                </div>
                            @endcan
                        </div>
                        @if ($errors->has('tipoProyecto'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('tipoProyecto') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left">Líneas de investigación <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            @foreach ($lineasInvestigacion as $key => $lineaInvestigacion)
                                <div class="custom-control custom-checkbox">
                                    @if (is_array(old('lineasInvestigacion')))
                                        <input id="lineasInvestigacion{{ $key }}" class="custom-control-input" type="checkbox" name="lineasInvestigacion[]" value="{{ $lineaInvestigacion->id }}" {{ old('lineasInvestigacion') == in_array($lineaInvestigacion->id, old('lineasInvestigacion')) ? 'checked' : '' }}>
                                    @else
                                        <input id="lineasInvestigacion{{ $key }}" class="custom-control-input" type="checkbox" name="lineasInvestigacion[]" value="{{ $lineaInvestigacion->id }}">
                                    @endif
                                    <label class="custom-control-label" for="lineasInvestigacion{{ $key }}">
                                        {{ $lineaInvestigacion->nombre }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @if ($errors->has('lineasInvestigacion'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('lineasInvestigacion') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="tituloProyecto">Título del proyecto <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input id="tituloProyecto" type="text" name="titulo" value="{{ old('titulo') }}" class="form-control{{ $errors->has('titulo') ? ' is-invalid' : '' }}" autocomplete="off" required>
                            @if ($errors->has('titulo'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('titulo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left">Coautores del proyecto</label>
                        <div class="col-md-9">
                            <p class="hint-text small">Busca al coautor por el número de documento</p>
                            <buscar-coautor :userdocumento="{{ auth()->user()->numeroDocumento }}"></buscar-coautor>

                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <img src="" alt="" class="rounded-circle" width="40">
                                    <p class="text-center m-0 ml-4">{{ auth()->user()->nombre }}</p>
                                    <span class="badge badge-primary">Autor</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="areaConocimiento1">#1 Área de conocimiento <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <select id="areaConocimiento1" name="areaConocimiento1" class="form-control{{ $errors->has('areaConocimiento1') ? ' is-invalid' : '' }}" required>
                                <option value="">Seleccione una área de conocimiento</option>
                                @foreach ($areasConocimiento as $areaConocimiento)
                                    <option value="{{ $areaConocimiento->nombre }}" {{ old('areaConocimiento1') == $areaConocimiento->nombre ? 'selected' : '' }}>{{ $areaConocimiento->nombre }}</option>
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
                                    <option value="{{ $areaConocimiento->nombre }}" {{ old('areaConocimiento2') == $areaConocimiento->nombre ? 'selected' : '' }}>{{ $areaConocimiento->nombre }}</option>
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
                                    <input id="fechaInicioProyecto" type="date" name="fechaInicioProyecto" value="{{ old('fechaInicioProyecto') }}" class="form-control{{ $errors->has('fechaInicioProyecto') ? ' is-invalid' : '' }}" required>
                                    @if ($errors->has('fechaInicioProyecto'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('fechaInicioProyecto') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-5">
                                    <label class="col-form-label text-md-left" for="fechaFinProyecto">Fecha de fin del proyecto</label>
                                    <input id="fechaFinProyecto" type="date" name="fechaFinProyecto" value="{{ old('fechaFinProyecto') }}" class="form-control{{ $errors->has('fechaFinProyecto') ? ' is-invalid' : '' }}" required>
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
                            <textarea id="antecedentesJustificacionProyecto" name="antecedentesJustificacionProyecto" rows="8" cols="80" class="form-control{{ $errors->has('antecedentesJustificacionProyecto') ? ' is-invalid' : '' }}" required>{{ old('antecedentesJustificacionProyecto') }}</textarea>
                            @if ($errors->has('antecedentesJustificacionProyecto'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('antecedentesJustificacionProyecto') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="planteamientoProblema">Planteamiento del problema <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <textarea id="planteamientoProblema" name="planteamientoProblema" rows="8" cols="80" class="form-control{{ $errors->has('planteamientoProblema') ? ' is-invalid' : '' }}" required>{{ old('planteamientoProblema') }}</textarea>
                            @if ($errors->has('planteamientoProblema'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('planteamientoProblema') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="metodologia">Metodología <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <textarea id="metodologia" name="metodologia" rows="8" cols="80" class="form-control{{ $errors->has('metodologia') ? ' is-invalid' : '' }}" required>{{ old('metodologia') }}</textarea>
                            @if ($errors->has('metodologia'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('metodologia') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="objetivoGeneral">Objetivo general <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <textarea id="objetivoGeneral" name="objetivoGeneral" class="form-control{{ $errors->has('objetivoGeneral') ? ' is-invalid' : '' }}" rows="8" cols="80" required>{{ old('objetivoGeneral') }}</textarea>
                            @if ($errors->has('objetivoGeneral'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('objetivoGeneral') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="objetivoEspecifico1">Objetivo específico Nro. 1 <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <textarea id="objetivoEspecifico1" name="objetivoEspecifico[]" class="form-control{{ $errors->has('objetivoEspecifico.0') ? ' is-invalid' : '' }}" rows="8" cols="80" required>{{ old('objetivoEspecifico.0') }}</textarea>
                            @if ($errors->has('objetivoEspecifico.0'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('objetivoEspecifico.0') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="objetivoEspecifico2">Objetivo específico Nro. 2 <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <textarea id="objetivoEspecifico2" name="objetivoEspecifico[]" class="form-control{{ $errors->has('objetivoEspecifico.1') ? ' is-invalid' : '' }}" rows="8" cols="80" required>{{ old('objetivoEspecifico.1') }}</textarea>
                            @if ($errors->has('objetivoEspecifico.1'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('objetivoEspecifico.1') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="objetivoEspecifico3">Objetivo específico Nro. 3 <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <textarea id="objetivoEspecifico3" name="objetivoEspecifico[]" class="form-control{{ $errors->has('objetivoEspecifico.2') ? ' is-invalid' : '' }}" rows="8" cols="80" required>{{ old('objetivoEspecifico.2') }}</textarea>
                            @if ($errors->has('objetivoEspecifico.2'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('objetivoEspecifico.2') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="objetivoEspecifico4">Objetivo específico Nro. 4</label>
                        <div class="col-md-9">
                            <textarea id="objetivoEspecifico4" name="objetivoEspecifico[]" class="form-control{{ $errors->has('objetivoEspecifico.3') ? ' is-invalid' : '' }}" rows="8" cols="80">{{ old('objetivoEspecifico.3') }}</textarea>
                            @if ($errors->has('objetivoEspecifico.3'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('objetivoEspecifico.3') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    @can ('info-grupo-investigacion')
                        <div class="form-group row" v-if="tipoProyecto != 'Proyecto formativo'">
                            <label class="col-md-3 col-form-label text-md-left" for="grupoInvestigacion">Grupo de investigación <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select id="grupoInvestigacion" class="form-control{{ $errors->has('grupoInvestigacion') ? ' is-invalid' : '' }}" name="grupoInvestigacion" required>
                                    @foreach ($gruposInvestigacion as $key => $grupoInvestigacion)
                                        <option value="{{ $grupoInvestigacion->id }}" {{ old('grupoInvestigacion') == $grupoInvestigacion->id  ? 'selected' : '' }}>{{ $grupoInvestigacion->nombre }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('grupoInvestigacion'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('grupoInvestigacion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row" v-if="tipoProyecto != 'Proyecto formativo'">
                            <label class="col-md-3 col-form-label text-md-left" for="codigoGruplac">Código Gruplac <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select id="codigoGruplac" class="form-control{{ $errors->has('codigoGruplac') ? ' is-invalid' : '' }}" name="codigoGruplac" required>
                                    @foreach ($gruplac as $key => $gruplac)
                                        <option value="{{ $gruplac->codigo }}" {{ old('codigoGruplac') == $gruplac->codigo  ? 'selected' : '' }}>{{ $gruplac->codigo }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('codigoGruplac'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('codigoGruplac') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endcan

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left">Semilleros beneficiados <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            @foreach ($semilleros as $key => $semillero)
                                <div class="custom-control custom-checkbox">
                                    @if (is_array(old('semillero')))
                                        <input id="semillero{{ $key }}" class="custom-control-input" type="checkbox" name="semillero[]" value="{{ $semillero->id }}" {{ old('semillero') == in_array($semillero->id, old('semillero')) ? 'checked' : '' }}>
                                    @else
                                        <input id="semillero{{ $key }}" class="custom-control-input" type="checkbox" name="semillero[]" value="{{ $semillero->id }}">
                                    @endif
                                    <label class="custom-control-label" for="semillero{{ $key }}">
                                        <strong>{{ $semillero->nombre }}</strong>
                                        {{-- <span data-toggle="tooltip" data-placement="right" title="{{ $semillero->descripcion }}"><i class="fas fa-question-circle"></i></span> --}}
                                        {{ $semillero->descripcion }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @if ($errors->has('semillero'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('semillero') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left">Programas de formación beneficiados</label>
                        <div class="col-md-9">
                            @foreach ($programasFormacion as $key => $programaFormacion)
                                <div class="custom-control custom-checkbox">
                                    @if (is_array(old('programaFormacion')))
                                        <input id="programaFormacion{{ $key }}" class="custom-control-input" type="checkbox" name="programaFormacion[]" value="{{ $programaFormacion->id }}" {{ old('programaFormacion') == in_array($programaFormacion->id, old('programaFormacion')) ? 'checked' : '' }}>
                                    @else
                                        <input id="programaFormacion{{ $key }}" class="custom-control-input" type="checkbox" name="programaFormacion[]" value="{{ $programaFormacion->id }}">
                                    @endif
                                    <label class="custom-control-label" for="programaFormacion{{ $key }}">
                                        {{ $programaFormacion->nombre }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @if ($errors->has('programaFormacion'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('programaFormacion') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="impactoSocial">Impacto social</label>
                        <div class="col-md-9">
                            <textarea id="impactoSocial" name="impactoSocial" rows="8" cols="80" class="form-control{{ $errors->has('impactoSocial') ? ' is-invalid' : '' }}">{{ old('impactoSocial') }}</textarea>
                            @if ($errors->has('impactoSocial'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('impactoSocial') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="impactoEconomico">Impacto económico</label>
                        <div class="col-md-9">
                            <textarea id="impactoEconomico" name="impactoEconomico" rows="8" cols="80" class="form-control{{ $errors->has('impactoEconomico') ? ' is-invalid' : '' }}">{{ old('impactoEconomico') }}</textarea>
                            @if ($errors->has('impactoEconomico'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('impactoEconomico') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="impactoTecnologico">Impacto tecnológico</label>
                        <div class="col-md-9">
                            <textarea id="impactoTecnologico" name="impactoTecnologico" rows="8" cols="80" class="form-control{{ $errors->has('impactoTecnologico') ? ' is-invalid' : '' }}">{{ old('impactoTecnologico') }}</textarea>
                            @if ($errors->has('impactoTecnologico'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('impactoTecnologico') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-left" for="impactoAmbiental">Impacto ambiental</label>
                        <div class="col-md-9">
                            <textarea id="impactoAmbiental" name="impactoAmbiental" rows="8" cols="80" class="form-control{{ $errors->has('impactoAmbiental') ? ' is-invalid' : '' }}">{{ old('impactoAmbiental') }}</textarea>
                            @if ($errors->has('impactoAmbiental'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('impactoAmbiental') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <posconflicto :errors="{{ $errors }}"></posconflicto>

                    <div class="form-group row mb-0">
                        <div class="col-md-9 offset-md-3">
                            <button type="submit" name="button" class="btn btn-primary mt-3">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
