@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('centros_formacion.update', $centroFormacion->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group row">
                <label class="col-md-3" for="nombreCentroFormacion">Nombre del centro de formación <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="nombreCentroFormacion" type="text" name="nombreCentroFormacion" class="form-control{{ $errors->has('nombreCentroFormacion') ? ' is-invalid' : '' }}" value="{{ $centroFormacion->nombreCentroFormacion }}" autocomplete="off" maxlength="191" required>
                    @if ($errors->has('nombreCentroFormacion'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('nombreCentroFormacion') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="nombreSubdirector">Nombre del subdirector <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="nombreSubdirector" type="text" name="nombreSubdirector" class="form-control{{ $errors->has('nombreSubdirector') ? ' is-invalid' : '' }}" value="{{ $centroFormacion->nombreSubdirector }}" autocomplete="off" maxlength="191" required>
                    @if ($errors->has('nombreSubdirector'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('nombreSubdirector') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="correoElectronicoSubdirector">Correo electrónico del subdirector <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="correoElectronicoSubdirector" type="email" name="correoElectronicoSubdirector" class="form-control{{ $errors->has('correoElectronicoSubdirector') ? ' is-invalid' : '' }}" value="{{ $centroFormacion->correoElectronicoSubdirector }}" autocomplete="off" maxlength="191" required>
                    @if ($errors->has('correoElectronicoSubdirector'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('correoElectronicoSubdirector') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="numeroCelularSubdirector">Número celular del subdirector <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="numeroCelularSubdirector" type="number" pattern="[0-9]" name="numeroCelularSubdirector" class="form-control{{ $errors->has('numeroCelularSubdirector') ? ' is-invalid' : '' }}" value="{{ $centroFormacion->numeroCelularSubdirector }}" autocomplete="off" min="0" max="99999999999" required>
                    @if ($errors->has('numeroCelularSubdirector'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('numeroCelularSubdirector') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="nombreLiderSennova">Nombre líder SENNOVA <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="nombreLiderSennova" type="text" name="nombreLiderSennova" class="form-control{{ $errors->has('nombreLiderSennova') ? ' is-invalid' : '' }}" value="{{ $centroFormacion->nombreLiderSennova }}" autocomplete="off" maxlength="191" required>
                    @if ($errors->has('nombreLiderSennova'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('nombreLiderSennova') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="correoElectronicoLiderSennova">Correo electrónico líder SENNOVA <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="correoElectronicoLiderSennova" type="email" name="correoElectronicoLiderSennova" class="form-control{{ $errors->has('correoElectronicoLiderSennova') ? ' is-invalid' : '' }}" value="{{ $centroFormacion->correoElectronicoLiderSennova }}" autocomplete="off" maxlength="191" required>
                    @if ($errors->has('correoElectronicoLiderSennova'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('correoElectronicoLiderSennova') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="numeroCelularLiderSennova">Número celular líder SENNOVA <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="numeroCelularLiderSennova" type="number" pattern="[0-9]" name="numeroCelularLiderSennova" class="form-control{{ $errors->has('numeroCelularLiderSennova') ? ' is-invalid' : '' }}" value="{{ $centroFormacion->numeroCelularLiderSennova }}" min="0" max="99999999999" autocomplete="off" required>
                    @if ($errors->has('numeroCelularLiderSennova'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('numeroCelularLiderSennova') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-9 offset-md-3">
                    <button type="submit" class="btn btn-primary">{{ __('Guardar cambios') }}</button>
                </div>
            </div>
        </form>

    </div>
@endsection
