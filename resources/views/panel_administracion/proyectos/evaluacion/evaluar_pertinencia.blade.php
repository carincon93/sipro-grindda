@extends('layouts.app')

@section('body_class', 'panel-planeacion')

@section('content')

    <div class="tab-content" id="pills-tabContent">

        {{-- @include('partials.menu-evaluacion', ['proyecto' => $proyecto]) --}}

        @push('planeacion')
            @include('partials.navbar-evaluacion-tecnica')
        @endpush

        @include('partials.messages')

        <div class="tab-content">

            <p class="mt-5 pl-4">Evaluación de pertinencia</p>
            <h3 class="descripcion-objetivo-especifico">{{ $proyecto->titulo }}</h3>

            <form action="{{ route('evaluacion.guardarPertinencia', $proyecto->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="datos-planeacion shadow p-4">
                    <div class="col-md-12">
                        <div class="row">
                            <label class="col-md-3 col-form-label text-md-left" for="nivelPertinencia">Pertinencia</label>
                            <div class="col-md-7">
                                <select name="nivelPertinencia" id="nivelPertinencia" class="form-control">
                                    <option value="">Seleccione la pertinencia del proyecto</option>
                                    <option value="3" {{ $proyecto->nivelPertinencia == 3 ? 'selected' : '' }}>Alta</option>
                                    <option value="2" {{ $proyecto->nivelPertinencia == 2 ? 'selected' : '' }}>Media</option>
                                    <option value="1" {{ $proyecto->nivelPertinencia == 1 ? 'selected' : '' }}>Baja</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="datos-planeacion shadow p-4">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Guardar evaluación de pertinencia</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
