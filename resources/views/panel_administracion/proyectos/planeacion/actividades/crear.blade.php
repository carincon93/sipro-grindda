@extends('layouts.app')

@section('content')
    @push('planeacion')
        @component('partials.menu-planeacion', ['proyecto' => $proyecto, 'idObjetivoEspecifico' => $proyecto->objetivosEspecificos->first()->id])

        @endcomponent

    @endpush
    @php
    $codigo = 'C0' . $nroActividad;
    @endphp

    <div class="container">
        <a href="{{ route('actividades.show', [$proyecto->id, $producto->resultado->objetivoEspecifico->id]) }}" class="btn btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>
        <div class="row">
            <div class="col-md-5">
                <strong>Asociar actividad al siguiente producto:</strong>
                <p>{{ $producto->descripcion }}</p>
            </div>
            <div class="col-md-7">
                @if (!$producto->hasAnyActividad($codigo, $producto->id))
                    <form action="{{ route('actividades.store', [$proyecto->id, $producto->id]) }}" method="POST">
                        @csrf

                        <input type="hidden" name="codigo" value="{{ $codigo }}">

                        <div class="form-group form-group-custom{{ $errors->has('descripcion') ? ' is-invalid' : '' }} required">
                            <label for="descripcion">Descripción de la actividad</label>
                            <textarea id="descripcion" name="descripcion" rows="4" cols="80" class="form-control" required>{{ old('descripcion') }}</textarea>

                            @if ($errors->has('descripcion'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('descripcion') }}</strong>
                                </span>
                            @endif

                        </div>

                        <actividades :errors="{{ $errors }}"></actividades>

                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                @else
                    <span class="invalid-feedback d-block">Ya tienes asociada la actividad {{ $nroActividad }} a este producto</span>
                @endif
            </div>
        </div>
    </div>
@endsection
