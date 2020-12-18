@extends('layouts.app')

@section('content')
    <div class="container">

        <form method="POST" action="{{ route('roles.update', $rol->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label for="nombre" class="col-sm-3 col-form-label">{{ __('Nombre') }} <span class="text-danger">*</span></label>

                <div class="col-md-9">
                    <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ $rol->nombre }}" required>

                    @if ($errors->has('nombre'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="nivelSeguridad" class="col-md-3 col-form-label">Nivel de seguridad <span class="text-danger">*</span></label>

                <div class="col-md-9">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input id="bajo" type="radio" name="nivelSeguridad" value="1" {{ $rol->nivelSeguridad == 1 ? 'checked' : '' }} {{ old('nivelSeguridad') == 1 ? 'checked' : '' }} class="custom-control-input" required>
                        <label class="custom-control-label" for="bajo">Bajo (Aprendices, Investigadores, Otros)</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input id="alto" type="radio" name="nivelSeguridad" value="5" {{ $rol->nivelSeguridad == 5 ? 'checked' : '' }} {{ old('nivelSeguridad') == 5 ? 'checked' : '' }} class="custom-control-input" required>
                        <label class="custom-control-label" for="alto">Alto (Administrador, Líderes)</label>
                    </div>

                    @if ($errors->has('nivelSeguridad'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('nivelSeguridad') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="descripcion" class="col-md-3 col-form-label">
                    {{ __('Notificaciones') }} <span class="text-danger">*</span>
                    <p class="small">Roles que recibirán notificaciones cuando el tipo de rol que esta creando envia un proyecto a evaluación</p>
                </label>

                <div class="col-md-9">
                    @foreach ($roles as $key => $rolBd)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="rol-slug{{$key+1}}" name="usuarioNotificacion[]" value="{{ __($rolBd->slug) }}" {{ old('usuarioNotificacion') == $rolBd->slug ? 'checked' : '' }} {{ !empty($rol->usuarioNotificacion[$rolBd->slug]) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="rol-slug{{$key+1}}">{{ __($rolBd->nombre) }}</label>
                        </div>
                    @endforeach

                    @if ($errors->has('usuarioNotificacion'))
                        <span class="invalid-feedback d-block">
                            <strong>{{ $errors->first('usuarioNotificacion') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="descripcion" class="col-md-3 col-form-label">{{ __('Descripción') }} <span class="text-danger">*</span></label>

                <div class="col-md-9">
                    <textarea id="descripcion" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" rows="8" cols="80" required>{{ $rol->descripcion }}</textarea>

                    @if ($errors->has('descripcion'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('descripcion') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Permisos para la caja de ideas</label>
                    <div class="col-md-9">
                        <div class="custom-control custom-checkbox">

                            <input type="checkbox" class="custom-control-input" id="ver-caja-ideas" name="permisos[]" value="{{ __('ver-caja-ideas') }}" {{ old('permisos') == 'ver-caja-ideas' ? 'checked' : '' }} {{ !empty($rol->permisos['ver-caja-ideas']) ? 'checked' : ''}} >
                            <label class="custom-control-label" for="ver-caja-ideas">{{ __('Ver ideas de la caja de ideas') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="editar-caja-ideas" name="permisos[]" value="{{ __('editar-caja-ideas') }}" {{ old('permisos') == 'editar-caja-ideas' ? 'checked' : '' }} {{ !empty($rol->permisos['editar-caja-ideas']) ? 'checked' : ''}} >
                            <label class="custom-control-label" for="editar-caja-ideas">{{ __('Editar ideas de la caja de ideas') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="eliminar-caja-ideas" name="permisos[]" value="{{ __('eliminar-caja-ideas') }}" {{ old('permisos') == 'eliminar-caja-ideas' ? 'checked' : '' }} {{ !empty($rol->permisos['eliminar-caja-ideas']) ? 'checked' : ''}} >
                            <label class="custom-control-label" for="eliminar-caja-ideas">{{ __('Eliminar ideas de la caja de ideas') }}</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Permisos para el tipo de proyecto</label>
                    <div class="col-md-9">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="proyecto-formativo" name="permisos[]" value="{{ __('proyecto-formativo') }}" {{ old('permisos') == 'proyecto-formativo' ? 'checked' : '' }} {{ !empty($rol->permisos['proyecto-formativo']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="proyecto-formativo">{{ __('Proyecto formativo') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="proyecto-investigacion" name="permisos[]" value="{{ __('proyecto-investigacion') }}" {{ old('permisos') == 'proyecto-investigacion' ? 'checked' : '' }} {{ !empty($rol->permisos['proyecto-investigacion']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="proyecto-investigacion">{{ __('Proyecto de investigación') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="proyecto-innovacion" name="permisos[]" value="{{ __('proyecto-innovacion') }}" {{ old('permisos') == 'proyecto-innovacion' ? 'checked' : '' }} {{ !empty($rol->permisos['proyecto-innovacion']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="proyecto-innovacion">{{ __('Proyecto de innovación') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="proyecto-modernizacion" name="permisos[]" value="{{ __('proyecto-modernizacion') }}" {{ old('permisos') == 'proyecto-modernizacion' ? 'checked' : '' }} {{ !empty($rol->permisos['proyecto-modernizacion']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="proyecto-modernizacion">{{ __('Proyecto de modernización') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="proyecto-divulgacion" name="permisos[]" value="{{ __('proyecto-divulgacion') }}" {{ old('permisos') == 'proyecto-divulgacion' ? 'checked' : '' }} {{ !empty($rol->permisos['proyecto-divulgacion']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="proyecto-divulgacion">{{ __('Proyecto de divulgación') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="proyecto-laboratorios" name="permisos[]" value="{{ __('proyecto-laboratorios') }}" {{ old('permisos') == 'proyecto-laboratorios' ? 'checked' : '' }} {{ !empty($rol->permisos['proyecto-laboratorios']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="proyecto-laboratorios">{{ __('Proyecto para el fortalecimiento de laboratorios') }}</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="permisos" class="col-sm-3 col-form-label">{{ __('Permisos de proyecto') }}</label>
                    <div class="col-md-9">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="crear-proyecto" name="permisos[]" value="{{ __('crear-proyecto') }}" {{ old('permisos') == 'crear-proyecto' ? 'checked' : '' }} {{ !empty($rol->permisos['crear-proyecto']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="crear-proyecto">{{ __('Crear proyecto') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="ver-proyecto" name="permisos[]" value="{{ __('ver-proyecto') }}" {{ old('permisos') == 'ver-proyecto' ? 'checked' : '' }} {{ !empty($rol->permisos['ver-proyecto']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="ver-proyecto">{{ __('Ver proyecto') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="editar-proyecto" name="permisos[]" value="{{ __('editar-proyecto') }}" {{ old('permisos') == 'editar-proyecto' ? 'checked' : '' }} {{ !empty($rol->permisos['editar-proyecto']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="editar-proyecto">{{ __('Editar proyecto') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="eliminar-proyecto" name="permisos[]" value="{{ __('eliminar-proyecto') }}" {{ old('permisos') == 'eliminar-proyecto' ? 'checked' : '' }} {{ !empty($rol->permisos['eliminar-proyecto']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="eliminar-proyecto">{{ __('Eliminar proyecto') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="generar-presupuesto" name="permisos[]" value="{{ __('generar-presupuesto') }}" {{ old('permisos') == 'generar-presupuesto' ? 'checked' : '' }} {{ !empty($rol->permisos['generar-presupuesto']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="generar-presupuesto">{{ __('Añadir presupuesto') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="info-grupo-investigacion" name="permisos[]" value="{{ __('info-grupo-investigacion') }}" {{ old('permisos') == 'info-grupo-investigacion' ? 'checked' : '' }} {{  !empty($rol->permisos['info-grupo-investigacion']) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="info-grupo-investigacion">{{ __('Información del grupo de investigación (Código Gruplac, Grupo de investigación)') }}</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="permisos" class="col-sm-3 col-form-label">{{ __('Permisos de información básica') }}</label>
                    <div class="col-md-9">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="crear-informacion" name="permisos[]" value="{{ __('crear-informacion') }}" {{ old('permisos') == 'crear-informacion' ? 'checked' : '' }} {{ !empty($rol->permisos['crear-informacion']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="crear-informacion">{{ __('Crear información básica (áreas de conocimiento, información del CPIC)') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="ver-informacion" name="permisos[]" value="{{ __('ver-informacion') }}" {{ old('permisos') == 'ver-informacion' ? 'checked' : '' }} {{ !empty($rol->permisos['ver-informacion']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="ver-informacion">{{ __('Ver información básica (áreas de conocimiento, información del CPIC)') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="editar-informacion" name="permisos[]" value="{{ __('editar-informacion') }}" {{ old('permisos') == 'editar-informacion' ? 'checked' : '' }} {{ !empty($rol->permisos['editar-informacion']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="editar-informacion"> {{ __('Editar información básica (áreas de conocimiento, información del CPIC)') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="eliminar-informacion" name="permisos[]" value="{{ __('eliminar-informacion') }}" {{ old('permisos') == 'eliminar-informacion' ? 'checked' : '' }} {{ !empty($rol->permisos['eliminar-informacion']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="eliminar-informacion">{{ __('Eliminar información básica (áreas de conocimiento, información del CPIC)') }}</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="permisos" class="col-sm-3 col-form-label">{{ __('Permisos de semillero') }}</label>
                    <div class="col-md-9">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="crear-semillero" name="permisos[]" value="{{ __('crear-semillero') }}" {{ old('permisos') == 'crear-semillero' ? 'checked' : '' }} {{ !empty($rol->permisos['crear-semillero']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="crear-semillero"> {{ __('Crear semillero') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="ver-semillero" name="permisos[]" value="{{ __('ver-semillero') }}" {{ old('permisos') == 'ver-semillero' ? 'checked' : '' }} {{ !empty($rol->permisos['ver-semillero']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="ver-semillero">{{ __('Ver semillero') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="editar-semillero" name="permisos[]" value="{{ __('editar-semillero') }}" {{ old('permisos') == 'editar-semillero' ? 'checked' : '' }} {{ !empty($rol->permisos['editar-semillero']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="editar-semillero">{{ __('Editar semillero') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="eliminar-semillero" name="permisos[]" value="{{ __('eliminar-semillero') }}" {{ old('permisos') == 'eliminar-semillero' ? 'checked' : '' }} {{ !empty($rol->permisos['eliminar-semillero']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="eliminar-semillero">{{ __('Eliminar semillero') }}</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="permisos" class="col-sm-3 col-form-label">{{ __('Permisos de programas de formación') }}</label>
                    <div class="col-md-9">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="crear-programa-formacion" name="permisos[]" value="{{ __('crear-programa-formacion') }}" {{ old('permisos') == 'crear-programa-formacion' ? 'checked' : '' }} {{ !empty($rol->permisos['crear-programa-formacion']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="crear-programa-formacion"> {{ __('Crear programa de formación') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="ver-programa-formacion" name="permisos[]" value="{{ __('ver-programa-formacion') }}" {{ old('permisos') == 'ver-programa-formacion' ? 'checked' : '' }} {{ !empty($rol->permisos['ver-programa-formacion']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="ver-programa-formacion"> {{ __('Ver programa de formación') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="editar-programa-formacion" name="permisos[]" value="{{ __('editar-programa-formacion') }}" {{ old('permisos') == 'editar-programa-formacion' ? 'checked' : '' }} {{ !empty($rol->permisos['editar-programa-formacion']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="editar-programa-formacion">{{ __('Editar programa de formación') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="eliminar-programa-formacion" name="permisos[]" value="{{ __('eliminar-programa-formacion') }}" {{ old('permisos') == 'eliminar-programa-formacion' ? 'checked' : '' }} {{ !empty($rol->permisos['eliminar-programa-formacion']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="eliminar-programa-formacion"> {{ __('Eliminar programa de formación') }}</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="permisos" class="col-sm-3 col-form-label">{{ __('Permisos de líneas de investigación') }}</label>
                    <div class="col-md-9">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="crear-linea-investigacion" name="permisos[]" value="{{ __('crear-linea-investigacion') }}" {{ old('permisos') == 'crear-linea-investigacion' ? 'checked' : '' }} {{ !empty($rol->permisos['crear-linea-investigacion']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="crear-linea-investigacion"> {{ __('Crear línea de investigación') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"  id="ver-linea-investigacion" name="permisos[]" value="{{ __('ver-linea-investigacion') }}" {{ old('permisos') == 'ver-linea-investigacion' ? 'checked' : '' }} {{ !empty($rol->permisos['ver-linea-investigacion']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="ver-linea-investigacion"> {{ __('Ver línea de investigación') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="editar-linea-investigacion" name="permisos[]" value="{{ __('editar-linea-investigacion') }}" {{ old('permisos') == 'editar-linea-investigacion' ? 'checked' : '' }} {{ !empty($rol->permisos['editar-linea-investigacion']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="editar-linea-investigacion"> {{ __('Editar línea de investigación') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="eliminar-linea-investigacion" name="permisos[]" value="{{ __('eliminar-linea-investigacion') }}" {{ old('permisos') == 'eliminar-linea-investigacion' ? 'checked' : '' }} {{ !empty($rol->permisos['eliminar-linea-investigacion']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="eliminar-linea-investigacion"> {{ __('Eliminar línea de investigación') }}</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="permisos" class="col-sm-3 col-form-label">{{ __('Permisos de grupo de investigación') }}</label>
                    <div class="col-md-9">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="crear-grupo-investigacion" name="permisos[]" value="{{ __('crear-grupo-investigacion') }}" {{ old('permisos') == 'crear-grupo-investigacion' ? 'checked' : '' }} {{ !empty($rol->permisos['crear-grupo-investigacion']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="crear-grupo-investigacion">{{ __('Crear grupo de investigación') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="ver-grupo-investigacion" name="permisos[]" value="{{ __('ver-grupo-investigacion') }}" {{ old('permisos') == 'ver-grupo-investigacion' ? 'checked' : '' }} {{ !empty($rol->permisos['ver-grupo-investigacion']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="ver-grupo-investigacion"> {{ __('Ver grupo de investigación') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="editar-grupo-investigacion" name="permisos[]" value="{{ __('editar-grupo-investigacion') }}" {{ old('permisos') == 'editar-grupo-investigacion' ? 'checked' : '' }} {{ !empty($rol->permisos['editar-grupo-investigacion']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="editar-grupo-investigacion"> {{ __('Editar grupo de investigación') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="eliminar-grupo-investigacion" name="permisos[]" value="{{ __('eliminar-grupo-investigacion') }}" {{ old('permisos') == 'eliminar-grupo-investigacion' ? 'checked' : '' }} {{ !empty($rol->permisos['eliminar-grupo-investigacion']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="eliminar-grupo-investigacion"> {{ __('Eliminar grupo de investigación') }}</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="permisos" class="col-sm-3 col-form-label">{{ __('Permisos de usuarios') }}</label>
                    <div class="col-md-9">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="crear-usuario" name="permisos[]" value="{{ __('crear-usuario') }}" {{ old('permisos') == 'crear-usuario' ? 'checked' : '' }} {{ !empty($rol->permisos['crear-usuario']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="crear-usuario"> {{ __('Crear usuario') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="ver-usuario" name="permisos[]" value="{{ __('ver-usuario') }}" {{ old('permisos') == 'ver-usuario' ? 'checked' : '' }} {{ !empty($rol->permisos['ver-usuario']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="ver-usuario"> {{ __('Ver usuario') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="editar-usuario" name="permisos[]" value="{{ __('editar-usuario') }}" {{ old('permisos') == 'editar-usuario' ? 'checked' : '' }} {{ !empty($rol->permisos['editar-usuario']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="editar-usuario"> {{ __('Editar usuario') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="eliminar-usuario" name="permisos[]" value="{{ __('eliminar-usuario') }}" {{ old('permisos') == 'eliminar-usuario' ? 'checked' : '' }} {{ !empty($rol->permisos['eliminar-usuario']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="eliminar-usuario"> {{ __('Eliminar usuario') }}</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="permisos" class="col-sm-3 col-form-label">{{ __('Permisos de roles') }}</label>
                    <div class="col-md-9">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="crear-rol" name="permisos[]" value="{{ __('crear-rol') }}" {{ old('permisos') == 'crear-rol' ? 'checked' : '' }} {{ !empty($rol->permisos['crear-rol']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="crear-rol"> {{ __('Crear rol') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="ver-rol" name="permisos[]" value="{{ __('ver-rol') }}" {{ old('permisos') == 'ver-rol' ? 'checked' : '' }} {{ !empty($rol->permisos['ver-rol']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="ver-rol">{{ __('Ver rol') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="editar-rol" name="permisos[]" value="{{ __('editar-rol') }}" {{ old('permisos') == 'editar-rol' ? 'checked' : '' }} {{ !empty($rol->permisos['editar-rol']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="editar-rol"> {{ __('Editar rol') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="eliminar-rol" name="permisos[]" value="{{ __('eliminar-rol') }}" {{ old('permisos') == 'eliminar-rol' ? 'checked' : '' }} {{ !empty($rol->permisos['eliminar-rol']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="eliminar-rol"> {{ __('Eliminar rol') }}</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="permisos" class="col-sm-3 col-form-label">{{ __('Permisos de convocatorias') }}</label>
                    <div class="col-md-9">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="crear-convocatoria" name="permisos[]" value="{{ __('crear-convocatoria') }}" {{ old('permisos') == 'crear-convocatoria' ? 'checked' : '' }} {{ !empty($rol->permisos['crear-convocatoria']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="crear-convocatoria">{{ __('Crear convocatoria') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="editar-convocatoria" name="permisos[]" value="{{ __('editar-convocatoria') }}" {{ old('permisos') == 'editar-convocatoria' ? 'checked' : '' }} {{ !empty($rol->permisos['editar-convocatoria']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="editar-convocatoria">  {{ __('Editar convocatoria') }}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="eliminar-convocatoria" name="permisos[]" value="{{ __('eliminar-convocatoria') }}" {{ old('permisos') == 'eliminar-convocatoria' ? 'checked' : '' }} {{ !empty($rol->permisos['eliminar-convocatoria']) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="eliminar-convocatoria"> {{ __('Eliminar convocatoria') }}</label>
                        </div>
                    </div>
                </div>

                @if ($errors->has('permisos'))
                    <span class="invalid-feedback d-block pl-4 pb-3">
                        <strong>{{ $errors->first('permisos') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-9 offset-md-3">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Guardar cambios') }}
                    </button>
                </div>
            </div>
        </form>

    </div>
@endsection
