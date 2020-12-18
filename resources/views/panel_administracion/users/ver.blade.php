@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mt-5 text-capitalize">{{ $usuario->nombre }}</h3>
        <hr>
        <h5>Datos personales</h5>

        <ul>
            <li><strong>Correo electrónico: </strong>{{ $usuario->email }}</li>
            <li><strong>Número de documento: </strong>{{ $usuario->numeroDocumento }}</li>
            <li><strong>Número de celular: </strong>{{ $usuario->numeroCelular }}</li>
            @isset($usuario->tipoVinculacion)
                <li><strong>Tipo de vinculación: </strong>{{ $usuario->tipoVinculacion }}</li>
            @endisset
            @isset($usuario->profesion)
                <li><strong>Profesión: </strong>{{ $usuario->profesion }}</li>
            @endisset
            @isset($usuario->lineaInvestigacion->nombre)
                <li>
                    <strong>Línea de investigación: </strong>
                    {{ $usuario->lineaInvestigacion->nombre }}
                </li>
            @endisset
            @isset($usuario->programaFormacion)
                <li>
                    <strong>Programa de formación: </strong>
                    {{ $usuario->programaFormacion->nombre }}
                </li>
            @endisset
            <li>
                <strong>Rol: </strong>
                {{ $usuario->roles->first()->nombre }}
            </li>
        </ul>

        <hr>

        <h5>Proyectos asociados</h5>

        @component('partials.tabla_proyectos', ['proyectos' => $usuario->proyectos])
            <p>No tiene proyectos asociados</p>
        @endcomponent

    </div>
@endsection
