@extends('layouts.app')

@section('content')
    <div class="container">

        <h4 class="mt-5">Proyectos formativos</h4>

        @component('partials.tabla_proyectos', ['proyectos' => $proyectos])
            <p>No tiene proyectos asociados</p>
        @endcomponent
    </div>
@endsection
