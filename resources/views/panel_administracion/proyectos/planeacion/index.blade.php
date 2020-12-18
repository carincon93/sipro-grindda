@extends('layouts.app')

@section('body_class', 'panel-planeacion')

@section('content')

    @push('planeacion')
        @component('partials.menu-planeacion', ['proyecto' => $proyecto, 'idObjetivoEspecifico' => $proyecto->objetivosEspecificos->first()->id])

        @endcomponent

    @endpush
    <div class="tab-content" id="pills-tabContent">
        <div class="nav flex-column nav-pills panel-izq" id="v-pills-tab" role="tablist" aria-orientation="vertical">

            @foreach ($proyecto->objetivosEspecificos as $key => $objetivoEspecifico)
                <a class="nav-link {{ $key == 0 ? 'active' : '' }}" id="v-pills-{{ $key }}-tab" data-toggle="pill" href="#v-pills-{{ $key }}" role="tab" aria-controls="v-pills-resultados" aria-selected="true">Objetivo específico {{ $key + 1 }}</a>
            @endforeach
        </div>

        <div class="tab-content panel-principal" id="v-pills-tabContent-1">
            @foreach ($proyecto->objetivosEspecificos as $key => $objetivoEspecifico)
                <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="v-pills-{{$key}}" role="tabpanel" aria-labelledby="v-pills-{{$key}}-tab">
                    <span>Descripción</span>
                    <p class="h1">
                        {{ $objetivoEspecifico->descripcion }}
                    </p>
                    @forelse ($objetivoEspecifico->resultados as $key => $resultado)
                        <div class="{{ ($key % 2 != 0) ? 'odd' : 'even' }}">
                            {{-- <span>{{ $resultado->codigo }}</span> --}}
                            <span>Descripción del resultado</span>
                            <p>
                                {{ $resultado->descripcion }}
                            </p>
                            @can ('evaluar-proyecto', $proyecto)
                                <a href="#">Evaluar este resultado</a>
                            @endcan
                            <a href="{{ route('resultados.editar', [$proyecto->id, $resultado->id]) }}">Editar</a>
                        </div>
                    @empty
                        <div>
                            <a href="{{ route('resultados.crear', [$proyecto->id, $objetivoEspecifico->id]) }}"><i class="fas fa-plus-circle"></i> Asociar resultados a este objetivo específico</a>
                        </div>
                    @endforelse
                </div>
            @endforeach
        </div>
    </div>
@endsection
