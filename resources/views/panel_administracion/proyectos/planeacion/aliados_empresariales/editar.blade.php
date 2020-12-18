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
                <h1>Aliados empresariales</h1>
            </div>
            <div class="col-md-7">
                @if ($entidadAliada->evaluacion)
                    @if ($entidadAliada->evaluacion->recomendacion)
                        <div class="alert alert-danger" role="alert">
                            <strong>Recomendación: </strong>{{ $entidadAliada->evaluacion->recomendacion }}
                    	</div>
                    @endif
                @endif
                <form action="{{ route('aliados.update', [$proyecto->id, $entidadAliada->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group form-group-custom{{ $errors->has('nombreAliado_Externo') ? ' is-invalid' : '' }} required">
                        <label for="nombreAliado_Externo">Nombre del aliado externo</label>
                        <input id="nombreAliado_Externo" type="text" name="nombreAliado_Externo" value="{{ $entidadAliada->nombreAliado }}" class="form-control" maxlength="191" required>

                        @if ($errors->has('nombreAliado_Externo'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('nombreAliado_Externo') }}</strong>
                            </span>
                        @endif

                    </div>
                    <div class="form-group form-group-custom{{ $errors->has('nitAliado_Externo') ? ' is-invalid' : '' }} required">
                        <label for="nitAliado_Externo">NIT</label>
                        <input id="nitAliado_Externo" type="text" name="nitAliado_Externo" value="{{ $entidadAliada->nit }}" class="form-control" maxlength="191" required>

                        @if ($errors->has('nitAliado_Externo'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('nitAliado_Externo') }}</strong>
                            </span>
                        @endif

                    </div>
                    <div class="form-group form-group-custom{{ $errors->has('nombreContactoAliado_Externo') ? ' is-invalid' : '' }} required">
                        <label for="nombreContactoAliado_Externo">Nombre del contacto</label>
                        <input id="nombreContactoAliado_Externo" type="text" name="nombreContactoAliado_Externo" value="{{ $entidadAliada->nombre }}" class="form-control" maxlength="191" required>

                        @if ($errors->has('nombreContactoAliado_Externo'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('nombreContactoAliado_Externo') }}</strong>
                            </span>
                        @endif

                    </div>
                    <div class="form-group form-group-custom{{ $errors->has('celularContactoAliado_Externo') ? ' is-invalid' : '' }} required">
                        <label for="celularContactoAliado_Externo">Número de celular del contacto</label>
                        <input id="celularContactoAliado_Externo" type="number" pattern="[0-9]" min="0" max="99999999999" name="celularContactoAliado_Externo" value="{{ $entidadAliada->celular }}" class="form-control" required>

                        @if ($errors->has('celularContactoAliado_Externo'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('celularContactoAliado_Externo') }}</strong>
                            </span>
                        @endif

                    </div>
                    <div class="form-group form-group-custom{{ $errors->has('emailContactoAliado_Externo') ? ' is-invalid' : '' }} required">
                        <label for="emailContactoAliado_Externo">Correo electrónico del contacto</label>
                        <input id="emailContactoAliado_Externo" type="email" name="emailContactoAliado_Externo" value="{{ $entidadAliada->email }}" class="form-control" maxlength="191" required>

                        @if ($errors->has('emailContactoAliado_Externo'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('emailContactoAliado_Externo') }}</strong>
                            </span>
                        @endif

                    </div>
                    <div class="form-group form-group-custom{{ $errors->has('convenioContactoAliado_Externo') ? ' is-invalid' : '' }} required">
                        <label for="convenioContactoAliado_Externo">Convenio</label>

                        <p class="small">La carta del convenio debe contener: firma de visto bueno del represante legal de la empresa y firma del subdirector de centro</p>
                        <p class="small">Máximo: 800KB</p>
                        <input id="convenioContactoAliado_Externo" type="file" name="convenioContactoAliado_Externo" value="{{ $entidadAliada->archivoAdjunto }}" class="form-control" accept="application/pdf">

                        @if ($errors->has('convenioContactoAliado_Externo'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('convenioContactoAliado_Externo') }}</strong>
                            </span>
                        @endif

                    </div>
                    <div class="form-group form-group-custom{{ $errors->has('recursosEspecie_Externo') ? ' is-invalid' : '' }} required">
                        <label for="recursosEspecie_Externo">Recursos en especie de entidad externa ($COP)</label>
                        <input id="recursosEspecie_Externo" type="number" pattern="[0-9]" min="0" max="99999999999" name="recursosEspecie_Externo" value="{{ $entidadAliada->recursosEspecie }}" class="form-control" required>

                        @if ($errors->has('recursosEspecie_Externo'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('recursosEspecie_Externo') }}</strong>
                            </span>
                        @endif

                    </div>
                    <div class="form-group form-group-custom{{ $errors->has('recursosDinero_Externo') ? ' is-invalid' : '' }} required">
                        <label for="recursosDinero_Externo">Recursos en dinero de entidad externa ($COP)</label>
                        <input id="recursosDinero_Externo" type="number" pattern="[0-9]" min="0" max="99999999999" name="recursosDinero_Externo" value="{{ $entidadAliada->recursosDinero }}" class="form-control" required>

                        @if ($errors->has('recursosDinero_Externo'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('recursosDinero_Externo') }}</strong>
                            </span>
                        @endif

                    </div>
                    <div class="form-group form-group-custom{{ $errors->has('ciudadesMunicipios_Externo') ? ' is-invalid' : '' }} required">
                        <label for="ciudadesMunicipios_Externo">Ciudades y/o municipios de influencia</label>
                        <input id="ciudadesMunicipios_Externo" type="text" name="ciudadesMunicipios_Externo" value="{{ $entidadAliada->ciudadesMunicipiosInfluencia }}" class="form-control" required>

                        @if ($errors->has('ciudadesMunicipios_Externo'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('ciudadesMunicipios_Externo') }}</strong>
                            </span>
                        @endif

                    </div>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
@endsection
