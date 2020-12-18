@extends('layouts.app')

@section('content')
    @push('planeacion')
        @component('partials.menu-planeacion', ['proyecto' => $proyecto, 'idObjetivoEspecifico' => $proyecto->objetivosEspecificos->first()->id])

        @endcomponent

    @endpush
    <div class="container">
        <a href="{{ route('resultados.show', [$proyecto->id, $resultado->objetivoEspecifico->id]) }}" class="btn btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>
        <div class="row">
            <div class="col-md-5">
                <strong>Asociar resultado al siguiente objetivo específico</strong>
                <p>{{ $resultado->objetivoEspecifico->descripcion }}</p>
            </div>
            <div class="col-md-7">
                @if ($resultado->evaluacion)
                    @if ($resultado->evaluacion->recomendacion)
                        <div class="alert alert-danger" role="alert">
                            <p class="m-0"><strong>Recomendación: </strong>{{ $resultado->evaluacion->recomendacion }}</p>
                    	</div>
                    @endif
                @endif

                <form action="{{ route('resultados.update', [$proyecto->id, $resultado->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- <input type="hidden" name="objetivoEspecificoId" value="{{ $resultado->objetivo_especifico_id }}"> --}}
                    <input type="hidden" name="codigo" value="{{ $resultado->codigo }}">

                    <div class="form-group form-group-custom required{{ $errors->has('descripcion') ? ' is-invalid' : '' }}">
                        <label for="descripcion">Descripción del resultado</label>
                        <textarea id="descripcion" name="descripcion" rows="4" cols="80" class="form-control" required>{{ $resultado->descripcion }}</textarea>

                        @if ($errors->has('descripcion'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('descripcion') }}</strong>
                            </span>
                        @endif

                    </div>
                    <div>
                        <div class="form-group form-group-custom required{{ $errors->has('indicador') ? ' is-invalid' : '' }}">
                            <label for="indicador">Indicador</label>
                            <textarea id="indicador" name="indicador" rows="4" cols="80" class="form-control" required>{{ $resultado->indicador }}</textarea>

                            @if ($errors->has('indicador'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('indicador') }}</strong>
                                </span>
                            @endif

                        </div>
                    </div>
                    <div>
                        <div class="form-group form-group-custom required{{ $errors->has('medioVerificacion') ? ' is-invalid' : '' }}">
                            <label for="medioVerificacion">Medio de verificación</label>
                            <input id="medioVerificacion" type="text" name="medioVerificacion" value="{{ $resultado->medioVerificacion }}" class="form-control" maxlength="191" required>

                            @if ($errors->has('medioVerificacion'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('medioVerificacion') }}</strong>
                                </span>
                            @endif

                        </div>
                    </div>
                    <div>
                        <div class="form-group form-group-custom required{{ $errors->has('meta') ? ' is-invalid' : '' }}">
                            <label for="meta">Meta</label>
                            <input id="meta" type="text" name="meta" value="{{ $resultado->meta }}" class="form-control" required>

                            @if ($errors->has('meta'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('meta') }}</strong>
                                </span>
                            @endif

                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar resultado</button>
                </form>
            </div>
        </div>
    </div>

@endsection
