@extends('layouts.app')

@section('content')
<div class="container">

    <h4 class="mt-5">Mis proyectos</h4>

    <hr>

    @isset($convocatoria)
        <p class="p-2 text-primary border border-primary">
            {{ $convocatoria->descripcion }}
            <i class="far fa-calendar-alt"></i> Fechas:
            <strong><span class="fecha">{{ $convocatoria->fecha_inicio }}</span></strong>
            hasta el
            <strong><span class="fecha">{{ $convocatoria->fecha_fin }}</span></strong>
        </p>
    @endisset

    @can ('crear-proyecto')
        <a href="{{ route('proyectos.create') }}" class="btn btn-primary">Formular proyecto</a>
    @endcan

    @include('partials.messages')

    @component('partials.tabla_proyectos', ['proyectos' => auth()->user()->proyectos])
        <p>No tienes proyectos asociados</p>
    @endcomponent

    </table>
</div>
@endsection
