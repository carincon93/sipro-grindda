@extends('layouts.app')

@section('content')
    @push('planeacion')
        @component('partials.menu-planeacion', ['proyecto' => $proyecto, 'idObjetivoEspecifico' => $proyecto->objetivosEspecificos->first()->id])

        @endcomponent

    @endpush
    <div class="container">
        <a href="{{ route('productos.show', [$proyecto->id, $producto->resultado->objetivoEspecifico->id]) }}" class="btn btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>
        <div class="row">
            <div class="col-md-5">
                <strong>Asociar producto al siguiente resultado</strong>
                <p>{{ $producto->resultado->descripcion }}</p>
            </div>
            <div class="col-md-7">
                @if ($producto->evaluacion)
                    @if ($producto->evaluacion->recomendacion)
                        <div class="alert alert-danger" role="alert">
                            <p class="m-0"><strong>Recomendación: </strong>{{ $producto->evaluacion->recomendacion }}</p>
                    	</div>
                    @endif
                @endif
                <form action="{{ route('productos.update', [$proyecto->id, $producto->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- <input type="hidden" name="resultadoId" value="{{ $producto->resultado_id }}"> --}}
                    <input type="hidden" name="codigo" value="{{ $producto->codigo }}">
                    <div>
                        {{-- <h1>Producto {{ $nroProducto }}</h1> --}}
                    </div>
                    <div class="form-group form-group-custom{{ $errors->has('descripcion') ? ' is-invalid' : '' }} required">
                        <label for="descripcion">Descripción del producto</label>
                        <textarea id="descripcion" name="descripcion" rows="4" cols="80" class="form-control" required>{{ $producto->descripcion }}</textarea>
                        @if ($errors->has('descripcion'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('descripcion') }}</strong>
                            </span>
                        @endif
                    </div>

                    <productos-editar :errors="{{ $errors }}" :datos="{{ $producto }}"></productos-editar>

                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>


    </div>

@endsection
