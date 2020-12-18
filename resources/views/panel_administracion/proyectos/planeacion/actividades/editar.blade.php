@extends('layouts.app')

@section('content')
    @push('planeacion')
        @component('partials.menu-planeacion', ['proyecto' => $proyecto, 'idObjetivoEspecifico' => $proyecto->objetivosEspecificos->first()->id])

        @endcomponent

    @endpush
    <div class="container">
        <a href="{{ route('actividades.show', [$proyecto->id, $actividad->producto->resultado->objetivoEspecifico->id]) }}" class="btn btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>
        <div class="row">
            <div class="col-md-5">
                <strong>Asociar actividad al siguiente producto:</strong>
                <p>{{ $actividad->producto->descripcion }}</p>
            </div>
            <div class="col-md-7">
                @if ($actividad->evaluacion)
                    @if ($actividad->evaluacion->recomendacion)
                        <div class="alert alert-danger" role="alert">
                            <p class="m-0"><strong>Recomendación: </strong>{{ $actividad->evaluacion->recomendacion }}</p>
                        </div>
                    @endif
                @endif
                <form action="{{ route('actividades.update', [$proyecto->id, $actividad->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="codigo" value="{{ $actividad->codigo }}">

                    <div class="form-group form-group-custom{{ $errors->has('descripcion') ? ' is-invalid' : '' }} required">
                        <label for="descripcion">Descripción de la actividad</label>
                        <textarea id="descripcion" name="descripcion" rows="8" cols="80" class="form-control" required>{{ $actividad->descripcion }}</textarea>

                        @if ($errors->has('descripcion'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('descripcion') }}</strong>
                            </span>
                        @endif

                    </div>

                    <actividades-editar :errors="{{ $errors }}" :datos="{{ $actividad }}"></actividades-editar>

                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </form>
            </div>
        </div>

    </div>
@endsection
