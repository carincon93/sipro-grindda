@extends('layouts.app')

@section('content')
    @push('planeacion')
        @component('partials.menu-planeacion', ['proyecto' => $proyecto, 'idObjetivoEspecifico' => $proyecto->objetivosEspecificos->first()->id])

        @endcomponent

    @endpush
    <div class="container">
        <a href="{{ route('aliados.index', $proyecto->id) }}" class="btn btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>
        <div class="row">
            <div class="col-md-5">
                <h1>Aliado empresarial</h1>
            </div>
            <div class="col-md-7">
                <form action="{{ route('aliados.store', $proyecto->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group form-group-custom{{ $errors->has('nombreAliado_Externo') ? ' is-invalid' : '' }} required">
                        <label for="nombreAliado_Externo">Nombre del aliado externo</label>
                        <input id="nombreAliado_Externo" type="text" name="nombreAliado_Externo" value="{{ old('nombreAliado_Externo') }}" class="form-control" maxlength="191" required>

                        @if ($errors->has('nombreAliado_Externo'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('nombreAliado_Externo') }}</strong>
                            </span>
                        @endif

                    </div>
                    <div class="form-group form-group-custom{{ $errors->has('nitAliado_Externo') ? ' is-invalid' : '' }} required">
                        <label for="nitAliado_Externo">NIT</label>
                        <input id="nitAliado_Externo" type="text" name="nitAliado_Externo" value="{{ old('nitAliado_Externo') }}" class="form-control" maxlength="191" required>

                        @if ($errors->has('nitAliado_Externo'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('nitAliado_Externo') }}</strong>
                            </span>
                        @endif

                    </div>
                    <div class="form-group form-group-custom{{ $errors->has('nitAliado_Externo') ? ' is-invalid' : '' }} required">
                        <label for="nombreContactoAliado_Externo">Nombre del contacto</label>
                        <input id="nombreContactoAliado_Externo" type="text" name="nombreContactoAliado_Externo" value="{{ old('nombreContactoAliado_Externo') }}" class="form-control" maxlength="191" required>

                        @if ($errors->has('nombreContactoAliado_Externo'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('nombreContactoAliado_Externo') }}</strong>
                            </span>
                        @endif

                    </div>
                    <div class="form-group form-group-custom{{ $errors->has('celularContactoAliado_Externo') ? ' is-invalid' : '' }} required">
                        <label for="celularContactoAliado_Externo">Número de celular del contacto</label>
                        <input id="celularContactoAliado_Externo" type="number" pattern="[0-9]" name="celularContactoAliado_Externo" value="{{ old('celularContactoAliado_Externo') }}" class="form-control" min="0" max="99999999999"  required>

                        @if ($errors->has('celularContactoAliado_Externo'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('celularContactoAliado_Externo') }}</strong>
                            </span>
                        @endif

                    </div>
                    <div class="form-group form-group-custom{{ $errors->has('emailContactoAliado_Externo') ? ' is-invalid' : '' }} required">
                        <label for="emailContactoAliado_Externo">Correo electrónico del contacto</label>
                        <input id="emailContactoAliado_Externo" type="email" name="emailContactoAliado_Externo" value="{{ old('emailContactoAliado_Externo') }}" class="form-control" maxlength="191" required>

                        @if ($errors->has('emailContactoAliado_Externo'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('emailContactoAliado_Externo') }}</strong>
                            </span>
                        @endif

                    </div>
                    <div class="form-group form-group-custom{{ $errors->has('convenioContactoAliado_Externo') ? ' is-invalid' : '' }} required">
                        <label for="convenioContactoAliado_Externo">Convenio</label>
                        <p class="small">
                            La carta del convenio debe contener: firma de visto bueno del represante legal de la empresa y firma del subdirector de centro
                        </p>
                        <p class="small">Máximo: 800KB</p>
                        <input id="convenioContactoAliado_Externo" type="file" name="convenioContactoAliado_Externo" value="{{ old('convenioContactoAliado_Externo') }}" class="form-control" accept="application/pdf" required>

                        @if ($errors->has('convenioContactoAliado_Externo'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('convenioContactoAliado_Externo') }}</strong>
                            </span>
                        @endif

                    </div>
                    <div class="form-group form-group-custom{{ $errors->has('recursosEspecie_Externo') ? ' is-invalid' : '' }} required">
                        <label for="recursosEspecie_Externo">Recursos en especie de entidad externa ($COP)</label>
                        <input id="recursosEspecie_Externo" type="number" pattern="[0-9]" name="recursosEspecie_Externo" value="{{ old('recursosEspecie_Externo') }}" class="form-control" min="0" max="99999999999" required>

                        @if ($errors->has('recursosEspecie_Externo'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('recursosEspecie_Externo') }}</strong>
                            </span>
                        @endif

                    </div>
                    <div class="form-group form-group-custom{{ $errors->has('recursosDinero_Externo') ? ' is-invalid' : '' }} required">
                        <label for="recursosDinero_Externo">Recursos en dinero de entidad externa ($COP)</label>
                        <input id="recursosDinero_Externo" type="number" pattern="[0-9]" name="recursosDinero_Externo" value="{{ old('recursosDinero_Externo') }}" class="form-control" min="0" max="99999999999" required>

                        @if ($errors->has('recursosDinero_Externo'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('recursosDinero_Externo') }}</strong>
                            </span>
                        @endif

                    </div>
                    <div class="form-group form-group-custom{{ $errors->has('ciudadesMunicipios_Externo') ? ' is-invalid' : '' }} required">
                        <label for="ciudadesMunicipios_Externo">Ciudades y/o municipios de influencia</label>
                        <input id="ciudadesMunicipios_Externo" type="text" name="ciudadesMunicipios_Externo" value="{{ old('ciudadesMunicipios_Externo') }}" class="form-control" required>

                        @if ($errors->has('ciudadesMunicipios_Externo'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('ciudadesMunicipios_Externo') }}</strong>
                            </span>
                        @endif

                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
