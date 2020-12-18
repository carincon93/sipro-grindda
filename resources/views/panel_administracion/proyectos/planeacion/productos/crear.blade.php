@extends('layouts.app')

@section('content')
    @push('planeacion')
        @component('partials.menu-planeacion', ['proyecto' => $proyecto, 'idObjetivoEspecifico' => $proyecto->objetivosEspecificos->first()->id])

        @endcomponent

    @endpush
    @php
    $codigo = 'P0' . $nroProducto;
    @endphp
    <div class="container">
        <a href="{{ route('productos.show', [$proyecto->id, $resultado->objetivoEspecifico->id]) }}" class="btn btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>
        <div class="row">
            <div class="col-md-5">
                <strong>Asociar producto al siguiente resultado</strong>
                <p>{{ $resultado->descripcion }}</p>
            </div>
            <div class="col-md-7">
                @if (!$resultado->hasAnyProducto($codigo, $resultado->id))
                    <form action="{{ route('productos.store', [$proyecto->id, $resultado->id]) }}" method="POST">
                        @csrf
                        {{-- <input type="hidden" name="resultadoId" value="{{ $resultado->id }}"> --}}
                        <input type="hidden" name="codigo" value="{{ $codigo }}">
                        <div class="form-group form-group-custom{{ $errors->has('descripcion') ? ' is-invalid' : '' }} required">
                            <label for="descripcion">Descripción del producto</label>
                            <textarea id="descripcion" name="descripcion" rows="4" cols="80" class="form-control" required>{{ old('descripcion') }}</textarea>

                            @if ($errors->has('descripcion'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('descripcion') }}</strong>
                                </span>
                            @endif

                        </div>

                        <productos :errors="{{ $errors }}"></productos>

                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                @else
                    <span class="invalid-feedback d-block">Ya tienes asociado el producto {{ $nroProducto }} a este resultado</span>
                @endif
            </div>
        </div>
    </div>
@endsection
