@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group row">
                <label class="col-md-3" for="nombre">Nombre completo <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="nombre" type="text" name="nombre" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" value="{{ $usuario->nombre }}" autocomplete="off" maxlength="191" required>

                    @if ($errors->has('nombre'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                    @endif

                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3" for="email">Dirección de correo electrónico <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="email" type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $usuario->email }}" autocomplete="off" maxlength="191" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="tipoDocumento">Tipo de documento <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <select class="form-control{{ $errors->has('tipoDocumento') ? ' is-invalid' : '' }}" name="tipoDocumento" id="tipoDocumento" required>
                        <option value="CC" {{ $usuario->tipoDocumento == 'CC' ? 'selected' : '' }}>Cédula de ciudadanía</option>
                        <option value="TI" {{ $usuario->tipoDocumento == 'TI' ? 'selected' : '' }}>Tarjeta de identidad</option>
                    </select>

                    @if ($errors->has('tipoDocumento'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('tipoDocumento') }}</strong>
                        </span>
                    @endif

                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="numeroDocumento">Número de documento <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="numeroDocumento" type="number" pattern="[0-9]" name="numeroDocumento" class="form-control{{ $errors->has('numeroDocumento') ? ' is-invalid' : '' }}" value="{{ $usuario->numeroDocumento }}" autocomplete="off" min="0" max="9999999999" required>

                    @if ($errors->has('numeroDocumento'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('numeroDocumento') }}</strong>
                        </span>
                    @endif

                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="numeroCelular">Número de celular</label>
                <div class="col-md-9">
                    <input id="numeroCelular" type="number" pattern="[0-9]" name="numeroCelular" class="form-control{{ $errors->has('numeroCelular') ? ' is-invalid' : '' }}" value="{{  $usuario->numeroCelular }}" autocomplete="off" min="0" max="9999999999">

                    @if ($errors->has('numeroCelular'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('numeroCelular') }}</strong>
                        </span>
                    @endif

                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="tipoVinculacion">Tipo de vinculación</label>
                <div class="col-md-9">
                    <select class="form-control{{ $errors->has('tipoVinculacion') ? ' is-invalid' : '' }}" name="tipoVinculacion" id="tipoVinculacion">
                        <option value="">Seleccione el tipo de vinculación</option>
                        <option value="investigador de planta" {{ $usuario->tipoVinculacion == 'investigador de planta' ? 'selected' : '' }}>Investigador de planta</option>
                        <option value="investigador contratista" {{ $usuario->tipoVinculacion == 'investigador contratista' ? 'selected' : '' }}>Investigador contratista</option>
                        <option value="funcionario de planta" {{ $usuario->tipoVinculacion == 'funcionario de planta' ? 'selected' : '' }}>Funcionario de planta</option>
                        <option value="funcionario contratista" {{ $usuario->tipoVinculacion == 'funcionario contratista' ? 'selected' : '' }}>Funcionario contratista</option>
                        <option value="instructor de planta" {{ $usuario->tipoVinculacion == 'instructor de planta' ? 'selected' : '' }}>Instructor de planta</option>
                        <option value="instructor contratista" {{ $usuario->tipoVinculacion == 'instructor contratista' ? 'selected' : '' }}>Instructor contratista</option>
                        <option value="aprendiz" {{ $usuario->tipoVinculacion == 'aprendiz' ? 'selected' : '' }}>Aprendiz</option>
                    </select>

                    @if ($errors->has('tipoVinculacion'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('tipoVinculacion') }}</strong>
                        </span>
                    @endif

                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="profesion">Profesión</label>
                <div class="col-md-9">
                    <input id="profesion" type="text" name="profesion" class="form-control{{ $errors->has('profesion') ? ' is-invalid' : '' }}" value="{{ $usuario->profesion }}" autocomplete="off" maxlength="191">

                    @if ($errors->has('profesion'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('profesion') }}</strong>
                        </span>
                    @endif

                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="lineaInvestigacion">Línea de investigación</label>
                <div class="col-md-9">
                    <select id="lineaInvestigacion" class="form-control{{ $errors->has('lineaInvestigacion') ? ' is-invalid' : '' }}" name="lineaInvestigacion">
                        @foreach ($lineasInvestigacion as $key => $lineaInvestigacion)
                            <option value="{{ $lineaInvestigacion->id }}" {{ $lineaInvestigacion->id == $usuario->linea_investigacion_id ? 'selected' : '' }}>{{ $lineaInvestigacion->nombre }}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('lineaInvestigacion'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('lineaInvestigacion') }}</strong>
                        </span>
                    @endif

                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="foto">Foto</label>
                <div class="col-md-9">
                    <input id="foto" type="file" name="foto" class="form-control{{ $errors->has('foto') ? ' is-invalid' : '' }}" value="{{$usuario->foto }}" accept="image/*">

                    @if ($errors->has('foto'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('foto') }}</strong>
                        </span>
                    @endif

                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="rol_user">Rol en el sistema <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <select name="rol_user" id="rol_user" class="form-control{{ $errors->has('rol_user') ? ' is-invalid' : '' }}" required>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}" {{ $usuario->roles->contains($rol) ? 'selected' : '' }}>{{ $rol->nombre }}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('rol_user'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('rol_user') }}</strong>
                        </span>
                    @endif

                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-9 offset-md-3">
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </form>

    </div>
@endsection
