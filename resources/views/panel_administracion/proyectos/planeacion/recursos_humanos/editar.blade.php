@extends('layouts.app')

@section('content')
    @push('planeacion')
        @component('partials.menu-planeacion', ['proyecto' => $proyecto, 'idObjetivoEspecifico' => $proyecto->objetivosEspecificos->first()->id])

        @endcomponent

    @endpush
    <div class="container">
        <div class="row">
            <div class="col-md-5">Editar personal</div>
            <div class="col-md-7">
                @if ($recursoHumano->evaluacion)
                    @if ($recursoHumano->evaluacion->recomendacion)
                        <div class="alert alert-danger" role="alert">
                            <p class="m-0"><strong>Recomendación: </strong>{{ $recursoHumano->evaluacion->recomendacion }}</p>
                    	</div>
                    @endif
                @endif
                <form action="{{ route('recursos_humanos.update', [$proyecto->id, $recursoHumano->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group form-group-custom{{ $errors->has('personalNombre') ? ' is-invalid' : '' }} required">
                        <label for="personalNombre">Nombre completo</label>

                            <input id="personalNombre" type="text" name="personalNombre" value="{{ $recursoHumano->nombrePersonal }}" class="form-control{{ $errors->has('personalNombre') ? ' is-invalid' : '' }}" maxlength="191" required>

                            @if ($errors->has('personalNombre'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('personalNombre') }}</strong>
                                </span>
                            @endif

                    </div>
                    <div class="form-group form-group-custom{{ $errors->has('personalNumeroDocumento') ? ' is-invalid' : '' }} required">
                        <label for="personalDocumento">Número de documento</label>
                        <input id="personalDocumento" type="number" pattern="[0-9]" min="0" max="99999999999" name="personalNumeroDocumento" value="{{ $recursoHumano->numeroDocumentoPersonal }}" class="form-control{{ $errors->has('personalNumeroDocumento') ? ' is-invalid' : '' }}" required>

                        @if ($errors->has('personalNumeroDocumento'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('personalNumeroDocumento') }}</strong>
                            </span>
                        @endif

                    </div>
                    @if ($recursoHumano->personalInstructor == true)
                        <div class="form-group form-group-custom{{ $errors->has('personalInstructorCarta') ? ' is-invalid' : '' }}">
                            <label for="personalInstructorCarta">Carta de compromiso</label>
                            <input id="personalInstructorCarta" type="file" name="personalInstructorCarta" class="form-control{{ $errors->has('personalInstructorCarta') ? ' is-invalid' : '' }}">

                            @if ($errors->has('personalInstructorCarta'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('personalInstructorCarta') }}</strong>
                                </span>
                            @endif

                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
@endsection
