@extends('layouts.app')

@section('body_class', 'welcome d-flex flex-column justify-content-center')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6" style="margin-left: 36.66666667%;">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group form-group-custom{{ $errors->has('email') ? ' is-invalid' : '' }}">
                        <label for="email" class="col-form-label text-md-left">{{ __('Dirección de correo electrónico') }}</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group form-group-custom{{ $errors->has('password') ? ' is-invalid' : '' }}">
                        <label for="password" class="col-form-label text-md-left">{{ __('Contraseña') }}</label>

                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="checkbox">
                            <label class="login-opciones">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Permanecer con la sesión iniciada') }}
                            </label>
                        </div>
                        <a href="{{ route('password.request') }}">
                            ¿Has olvidado la contraseña?
                        </a>
                    </div>

                    <button type="submit" class="btn btn-success">
                        {{ __('Iniciar sesión') }}
                    </button>
                </form>
                <div>
                    <p class="mt-4 login-opciones">
                        ¿Todavía no eres miembro?
                        <a href="{{ route('register') }}">Registrarse</a>
                    </p>
                </div>
                <div>
                    <a href="{{ route('archivos.borrador', 'Formato I+D+I.xlsx') }}">Descargar formato I+D+i</a>
                </div>
            </div>
        </div>
    </div>
@endsection