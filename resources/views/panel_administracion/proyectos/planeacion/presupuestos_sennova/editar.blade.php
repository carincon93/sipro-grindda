@extends('layouts.app')

@section('content')
    @push('planeacion')
        @component('partials.menu-planeacion', ['proyecto' => $proyecto, 'idObjetivoEspecifico' => $proyecto->objetivosEspecificos->first()->id])

        @endcomponent

    @endpush
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <p><strong>Descripción del rubro</strong></p>
                <p>
                    {{ $presupuesto->nombreItem }}
                </p>
            </div>
            <div class="col-md-7">
                @if ($presupuesto->evaluacion)
                    @if ($presupuesto->evaluacion->recomendacion)
                        <div class="alert alert-danger" role="alert">
                            <p class="m-0"><strong>Recomendación: </strong>{{ $presupuesto->evaluacion->recomendacion }}</p>
                    	</div>
                    @endif
                @endif
                <form action="{{ route('presupuestos_sennova.update', [$proyecto->id, $presupuesto->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <div class="form-group form-group-custom{{ $errors->has('valor') ? ' is-invalid' : '' }} required">
                            <input type="hidden" name="nombreItem" value="{{ $presupuesto->nombreItem }}" class="form-control">
                            <label for="valor">Valor en $COP</label>
                            <input id="valor" type="number" pattern="[0-9]" class="form-control" name="valor" value="{{ $presupuesto->valor }}" autocomplete="off" min="0" max="99999999999" required>

                            @if ($errors->has('valor'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('valor') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group form-group-custom{{ $errors->has('descripcion') ? ' is-invalid' : '' }} required">
                            <label for="descripcion">Descripción</label>
                            <input id="descripcion" type="text" class="form-control" name="descripcion" value="{{ $presupuesto->descripcion }}" autocomplete="off" required>

                            @if ($errors->has('descripcion'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('descripcion') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group form-group-custom{{ $errors->has('archivo') ? ' is-invalid' : '' }}">
                            <label for="archivo">Archivo</label>
                            <input id="archivo" type="file" name="archivo" class="form-control" accept="application/pdf">

                            @if ($errors->has('archivo'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('archivo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar cambios</button>

                </form>
            </div>
        </div>
    </div>
@endsection
