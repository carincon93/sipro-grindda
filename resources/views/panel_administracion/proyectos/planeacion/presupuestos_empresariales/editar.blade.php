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
                    {{ $presupuestoEmpresarial->nombreItem }}
                </p>
            </div>
            <div class="col-md-7">
                @if ($presupuestoEmpresarial->evaluacion)
                    @if ($presupuestoEmpresarial->evaluacion->recomendacion)
                        <div class="alert alert-danger" role="alert">
                            <p class="m-0"><strong>Recomendación: </strong>{{ $presupuestoEmpresarial->evaluacion->recomendacion }}</p>
                    	</div>
                    @endif
                @endif
                <form action="{{ route('presupuestos_empresariales.update', [$proyecto->id, $presupuestoEmpresarial->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group form-group-custom{{ $errors->has('valor') ? ' is-invalid' : '' }} required">
                        <input type="hidden" name="nombreItem" value="{{ $presupuestoEmpresarial->nombreItem }}" class="form-control">
                        <label for="valor">Valor en $COP</label>
                        <input  id="valor" type="number" pattern="[0-9]" class="form-control" name="valor" value="{{ $presupuestoEmpresarial->valor }}" autocomplete="off" min="0" max="99999999999" required>

                        @if ($errors->has('valor'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('valor') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group form-group-custom{{ $errors->has('descripcion') ? ' is-invalid' : '' }} required">
                        <label for="descripcion">Descripción</label>
                        <input id="descripcion" type="text" class="form-control" name="descripcion" value="{{ $presupuestoEmpresarial->descripcion }}" autocomplete="off" required>

                        @if ($errors->has('descripcion'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('descripcion') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group form-group-custom{{ $errors->has('archivo') ? ' is-invalid' : '' }} required">
                        <label for="archivo" >Archivo</label>
                        <input  id="archivo" type="file" name="archivo" class="form-control" required>

                        @if ($errors->has('archivo'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('archivo') }}</strong>
                            </span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar cambios</button>

                </form>
            </div>
        </div>
    </div>
@endsection
