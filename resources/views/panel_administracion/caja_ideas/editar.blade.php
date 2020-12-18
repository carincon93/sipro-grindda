@extends('layouts.app')
@section('content')

  <div class="container">
      <form class="form" action="{{ route('caja_ideas.update', $idea->id) }}" method="POST">
            @method('PUT')
            @csrf

            <div class="form-group row">
                <label class="col-md-3" for="nombreEmpresa">Nombre de la empresa <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="nombreEmpresa" type="text" class="form-control{{ $errors->has('nombreEmpresa') ? ' is-invalid' : '' }}" name="nombreEmpresa" value="{{ $idea->nombreEmpresa }}" required>

                    @if ($errors->has('nombreEmpresa'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('nombreEmpresa') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3" for="nit">NIT <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="nit" type="text" class="form-control{{ $errors->has('nit') ? ' is-invalid' : '' }}" name="nit" value="{{ $idea->nit }}" required>

                    @if ($errors->has('nit'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('nit') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="representanteLegal">Representante legal <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="representanteLegal" type="text" class="form-control{{ $errors->has('representanteLegal') ? ' is-invalid' : '' }}" name="representanteLegal" value="{{ $idea->representanteLegal }}" required>

                    @if ($errors->has('representanteLegal'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('representanteLegal') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="sectorEmpresa">Sector de la empresa <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="sectorEmpresa" type="text" class="form-control{{ $errors->has('sectorEmpresa') ? ' is-invalid' : '' }}" name="sectorEmpresa" value="{{ $idea->sectorEmpresa }}" required>

                    @if ($errors->has('sectorEmpresa'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('sectorEmpresa') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="nombrePersona">Persona encargada de proyectos <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="nombrePersona" type="text" class="form-control{{ $errors->has('nombrePersona') ? ' is-invalid' : '' }}" name="nombrePersona" value="{{ $idea->nombrePersona }}" required>

                    @if ($errors->has('nombrePersona'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('nombrePersona') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="telefonoCelular">Teléfono celular <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="telefonoCelular" type="number" pattern="[0-9]" class="form-control{{ $errors->has('telefonoCelular') ? ' is-invalid' : '' }}" name="telefonoCelular" value="{{ $idea->telefonoCelular }}" min="0" max="9999999999" required>

                    @if ($errors->has('telefonoFijo'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('telefonoFijo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="telefonoFijo">Teléfono fijo</label>
                <div class="col-md-9">
                    <input id="telefonoFijo" type="number" pattern="[0-9]" class="form-control{{ $errors->has('telefonoFijo') ? ' is-invalid' : '' }}" name="telefonoFijo" value="{{ $idea->telefonoFijo }}" min="0" max="9999999999">

                    @if ($errors->has('telefonoFijo'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('telefonoFijo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="correoElectronico">Dirección de correo electrónico <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="correoElectronico" type="email" class="form-control{{ $errors->has('correoElectronico') ? ' is-invalid' : '' }}" name="correoElectronico" value="{{ $idea->correoElectronico }}" required>
                    @if ($errors->has('correoElectronico'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('correoElectronico') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="idea">Idea <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <textarea id="idea" name="idea" required rows="4" cols="80" class="form-control{{ $errors->has('idea') ? ' is-invalid' : '' }}">{{ $idea->idea }}</textarea>
                    @if ($errors->has('idea'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('idea') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3" for="presupuesto">Presupuesto</label>
                <div class="col-md-9">
                    <input id="presupuesto" type="number" pattern="[0-9]" class="form-control{{ $errors->has('presupuesto') ? ' is-invalid' : '' }}" name="presupuesto" value="{{ $idea->presupuesto }}" min="0" max="9999999999">
                    @if ($errors->has('presupuesto'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('presupuesto') }}</strong>
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
