@extends('layouts.app')

@section('content')
    <div class="container">

        <h3 class="mt-5">{{ $rol->nombre }}</h3>

        <p>{{ $rol->descripcion }}</p>

        @isset($rol->permisos)
            <div>
                <h5>Permisos</h5>
                <ul>
                    @foreach ($rol->permisos as $key => $value)
                        <li>{{ $key }}</li>
                    @endforeach
                </ul>
            </div>
        @endisset
    </div>
@endsection
