@extends('layouts.app')

@section('content')
    <div class="container">

        <h4 class="mt-5">{{ $semillero->nombre }}</h4>

        @component('partials.tabla_proyectos', ['proyectos' => $semillero->proyectos])
            <p>No tiene proyectos asociados</p>
        @endcomponent
    </div>
@endsection
