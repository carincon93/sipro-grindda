@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label class="col-md-3" for="nombre">Nombre completo <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="nombre" type="text" name="nombre" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" value="{{ old('nombre') }}" autocomplete="off" maxlength="191" required>

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
                    <input id="email" type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" autocomplete="off" maxlength="191" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="contrasena">Tipo de contraseña <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    {{-- <p>La contraseña será el número de documento</p> --}}

                    <div class="custom-control custom-radio custom-control-inline">
                        <input id="contrasenaNumeroDocumento" type="radio" name="tipoContrasena" value="contrasenaNumeroDocumento" class="custom-control-input" v-model="selectedTipoContrasena" required>
                        <label class="custom-control-label" for="contrasenaNumeroDocumento">Número de documento como contraseña</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input id="contrasenaManual" type="radio" name="tipoContrasena" value="contrasenaManual" class="custom-control-input" v-model="selectedTipoContrasena" required>
                        <label class="custom-control-label" for="contrasenaManual">Contraseña manual</label>
                    </div>

                </div>
            </div>

            <div v-if="selectedTipoContrasena == 'contrasenaManual'">
                <div class="form-group row">
                    <label for="" class="col-md-3">Contraseña <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <p class="small">La contraseña debe tener mínimo 6 caracteres</p>
                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" pattern=".{6,}" maxlength="191" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-3">Confirmar contraseña <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="tipoDocumento">Tipo de documento <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <select class="form-control{{ $errors->has('tipoDocumento') ? ' is-invalid' : '' }}" name="tipoDocumento" id="tipoDocumento" required>
                        <option value="">Seleccione el tipo de documento</option>
                        <option value="CC" {{ old('tipoDocumento') == 'CC' ? 'selected' : '' }}>Cédula de ciudadanía</option>
                        <option value="TI" {{ old('tipoDocumento') == 'TI' ? 'selected' : '' }}>Tarjeta de identidad</option>
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
                    <input id="numeroDocumento" type="number" pattern="[0-9]" name="numeroDocumento" class="form-control{{ $errors->has('numeroDocumento') ? ' is-invalid' : '' }}" value="{{ old('numeroDocumento') }}" autocomplete="off" min="0" max="9999999999" required>

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
                    <input id="numeroCelular" type="number" pattern="[0-9]" name="numeroCelular" class="form-control{{ $errors->has('numeroCelular') ? ' is-invalid' : '' }}" value="{{  old('numeroCelular') }}" autocomplete="off" max="9999999999">

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
                        <option value="investigador de planta" {{ old('tipoVinculacion') == 'investigador de planta' ? 'selected' : '' }}>Investigador de planta</option>
                        <option value="investigador contratista" {{ old('tipoVinculacion') == 'investigador contratista' ? 'selected' : '' }}>Investigador contratista</option>
                        <option value="funcionario de planta" {{ old('tipoVinculacion') == 'funcionario de planta' ? 'selected' : '' }}>Funcionario de planta</option>
                        <option value="funcionario contratista" {{ old('tipoVinculacion') == 'funcionario contratista' ? 'selected' : '' }}>Funcionario contratista</option>
                        <option value="instructor de planta" {{ old('tipoVinculacion') == 'instructor de planta' ? 'selected' : '' }}>Instructor de planta</option>
                        <option value="instructor contratista" {{ old('tipoVinculacion') == 'instructor contratista' ? 'selected' : '' }}>Instructor contratista</option>
                        <option value="aprendiz" {{ old('tipoVinculacion') == 'aprendiz' ? 'selected' : '' }}>Aprendiz</option>
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
                    <input id="profesion" type="text" name="profesion" class="form-control{{ $errors->has('profesion') ? ' is-invalid' : '' }}" value="{{ old('profesion') }}" autocomplete="off" maxlength="191">

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
                        <option value="">Seleccione una línea de investigación</option>
                        @foreach ($lineasInvestigacion as $key => $lineaInvestigacion)
                            <option value="{{ $lineaInvestigacion->id }}" {{ old('lineaInvestigacion') == $lineaInvestigacion->id ? 'selected' : '' }}>{{ $lineaInvestigacion->nombre }}</option>
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
                    <input id="foto" type="file" name="foto" class="form-control{{ $errors->has('foto') ? ' is-invalid' : '' }}" value="{{ old('foto') }}" accept="image/*">

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
                        <option value="">Seleccione un rol</option>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}" {{ old('rol_user') == $rol->id ? 'selected' : '' }}>{{ $rol->nombre }}</option>
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
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>

    </div>
@endsection
