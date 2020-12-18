@extends('layouts.app')

@section('content')
    <div class="container">

        <h4 class="mt-5">Proyectos del grupo de investigación GRINDDA</h4>

        @include('partials.messages')

        @if ( $grupoInvestigacion->count() > 0 )
            @component('partials.tabla_proyectos', ['proyectos' => $grupoInvestigacion->proyectos])
                <p>No hay proyectos asociados al grupo de investigación</p>
            @endcomponent
        @endif
    </div>
@endsection
