@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <h3>SIPRO | Registrarse</h3>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group-custom">
                        <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" placeholder="Nombre completo *" required>

                        @if ($errors->has('nombre'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group-custom">
                        <input type="text" name="email" value="{{ old('email') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Dirección de correo electrónico *" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group-custom">
                        <p class="small mt-3">Tipo de documento <span class="text-danger">*</span></p>
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

                    <div class="form-group-custom">
                        <input id="numeroDocumento" type="number" class="form-control{{ $errors->has('numeroDocumento') ? ' is-invalid' : '' }}" name="numeroDocumento" value="{{ old('numeroDocumento') }}" placeholder="Número de documento *" max="9999999999" required>

                        @if ($errors->has('numeroDocumento'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('numeroDocumento') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group-custom">
                        <input id="numeroCelular" type="number" class="form-control{{ $errors->has('numeroCelular') ? ' is-invalid' : '' }}" name="numeroCelular" value="{{ old('numeroCelular') }}" placeholder="Número de celular" max="9999999999">

                        @if ($errors->has('numeroCelular'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('numeroCelular') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group-custom">
                        <p class="small mt-3">Programas de formación <span class="text-danger">*</span></p>
                        <select id="programaFormacion" class="form-control{{ $errors->has('programaFormacion') ? ' is-invalid' : '' }}" name="programaFormacion" required>
                            <option value="">Seleccione un programa de formación</option>
                            @foreach ($programasFormacion as $programaFormacion)
                                <option value="{{ $programaFormacion->id }}" {{ old('programaFormacion') == $programaFormacion->id ? 'selected' : '' }}>{{ $programaFormacion->nombre }}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('programaFormacion'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('programaFormacion') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group-custom">
                        <p class="small mt-3">Contraseña <span data-toggle="tooltip" data-placement="top" title="La contraseña debe contener mínimo 6 caracteres"><i class="fas fa-question-circle"></i></span></p>
                        <input id="password" pattern=".{6,}" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" type="password" title="6 caracteres mínimo" placeholder="Contraseña *" maxlength="191" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group-custom">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" pattern=".{6,}" title="6 caracteres mínimo" placeholder="Confirmar contraseña *" maxlength="191" required>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary mt-4">
                            {{ __('Registrarse') }}
                        </button>
                        <p class="mt-3">¿Ya dispones de una cuenta en SIPRO? <a href="{{ route('login') }}">Inicia sesión</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
