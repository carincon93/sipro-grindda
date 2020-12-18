<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIPRO') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Inline Scripts  -->
    <script>
    window.url      = "{{ url('/panel') }}";
    window.asset    = "{{ asset('') }}";
    window.cookie   = "{{ Cookie::get('nombre') }}";
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="@yield('body_class')">
    <div id="app">
        @auth
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel custom-navbar">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('proyectos.index') }}">
                        {{ config('app.name', 'SIPRO') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                {{-- <li><a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a></li>
                                <li><a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a></li> --}}
                            @else
                                <li>
                                    <ul class="list-unstyled">
                                        <notificaciones :userid="'{{ auth()->user()->id }}'" :userrol="'{{ auth()->user()->roles[0]->nivelSeguridad }}'"></notificaciones>
                                    </ul>
                                </li>
                                <li class="mr-3 ml-3 foto-usuario">
                                    <img src="{{ Storage::url(Auth::user()->foto) }}" alt="" width="35" class="rounded-circle">
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle nombre-usuario" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        @php
                                        $nombreCompleto = explode(" ", Auth::user()->nombre);
                                        $usuarioNombre  = implode(" ", array_splice($nombreCompleto, 0, 3));
                                        @endphp
                                        {{ $usuarioNombre }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Cerrar sesión') }}</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel p-0 navbar-acciones">
                <div class="container">
                    <div class="collapse navbar-collapse custom-second-navbar" id="navbarSupportedContent">
                        @if (!Request::is('panel/ver_planeacion*') && !Request::is('panel/evaluacion*'))
                        <ul class="nav nav-pills nav-tabs-gestion">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('panel/proyectos') ? 'active' : '' }}" href="{{ route('proyectos.index') }}">Mis proyectos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('panel/proyectos/grupo_investigacion*') ? 'active' : '' }}" href="{{ route('proyectos.grupoInvestigacion', 'grindda') }}">Proyectos GRINDDA</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('panel/proyectos_formativos*') ? 'active' : '' }}" href="{{ route('proyectos.formativos') }}">Proyectos formativos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('panel/proyectos_semilleros*') ? 'active' : '' }}" href="{{ route('proyectos.semilleros') }}">Proyectos semilleros</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdownProyectos" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Proyectos</a>
                                <div aria-labelledby="navbarDropdownProyectos" class="dropdown-menu">
                                    <div>
                                        <a class="dropdown-item {{ Request::is('panel/proyectos') ? 'active' : '' }}" href="{{ route('proyectos.index') }}">Mis proyectos</a>
                                    </div>
                                    <div>
                                        <a class="dropdown-item {{ Request::is('panel/proyectos/grupo_investigacion*') ? 'active' : '' }}" href="{{ route('proyectos.grupoInvestigacion', 'grindda') }}">Proyectos GRINDDA</a>
                                    </div>
                                    <div>
                                        <a class="dropdown-item {{ Request::is('panel/proyectos_formativos*') ? 'active' : '' }}" href="{{ route('proyectos.formativos') }}">Proyectos formativos</a>
                                    </div>
                                    <div>
                                        <a class="dropdown-item {{ Request::is('panel/proyectos_semilleros*') ? 'active' : '' }}" href="{{ route('proyectos.semilleros') }}">Proyectos semilleros</a>
                                    </div>
                                    <div>
                                        <a class="dropdown-item {{ Request::is('panel/convocatorias*') ? 'active' : '' }}" href="{{ route('convocatorias.index') }}">Convocatorias</a>
                                    </div>
                                    <div>
                                        <a class="dropdown-item {{ Request::is('panel/proyectos_priorizados*') ? 'active' : '' }}" href="{{ route('proyectos.priorizados') }}">Proyectos priorizados</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdownSENNOVA" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SENNOVA</a>
                                <div aria-labelledby="navbarDropdownSENNOVA" class="dropdown-menu">
                                    <div>
                                        <a class="dropdown-item" href="{{ route('caja_ideas.index') }}">Caja de ideas</a>
                                    </div>
                                    <div>
                                        <a class="dropdown-item" href="{{ route('grupos_investigacion.index') }}">Grupo de investigación</a>
                                    </div>
                                    <div>
                                        <a class="dropdown-item" href="{{ route('lineas_investigacion.index') }}">Líneas de investigación</a>
                                    </div>
                                    <div>
                                        <a class="dropdown-item" href="{{ route('logos_aliados.index') }}">Logos aliados</a>
                                    </div>
                                    <div>
                                        <a class="dropdown-item" href="{{ route('semilleros.index') }}">Semilleros</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdownFormacion" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Formación</a>
                                <div aria-labelledby="navbarDropdownFormacion" class="dropdown-menu">
                                    <div>
                                        <a class="dropdown-item" href="{{ route('areas_conocimiento.index') }}">Áreas de conocimiento</a>
                                    </div>
                                    <div>
                                        <a class="dropdown-item" href="{{ route('centros_formacion.index') }}">Información CPIC</a>
                                    </div>
                                    <div>
                                        <a class="dropdown-item" href="{{ route('programas_formacion.index') }}">Programas de formación</a>
                                    </div>
                                </div>
                            </li>


                            <li class="nav-item dropdown">
                                <a id="navbarDropdownUsuarios" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Usuarios</a>
                                <div aria-labelledby="navbarDropdownUsuarios" class="dropdown-menu">
                                    <div>
                                        <a class="dropdown-item {{ Request::is('panel/usuarios') ? 'active' : '' }}" href="{{ route('usuarios.index') }}">Usuarios grupo de investigación</a>
                                        <a class="dropdown-item {{ Request::is('panel/usuarios/aprendices*') ? 'active' : '' }}" href="{{ route('usuarios.aprendices') }}">Aprendices</a>
                                    </div>
                                </div>
                            </li>
                    
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('panel/roles*') ? 'active' : '' }}" href="{{ route('roles.index') }}">Roles</a>
                            </li>
                        </ul>
                        @else
                            <ul class="nav nav-pills nav-tabs-planeacion">
                                @stack('planeacion')
                            </ul>
                        @endif
                    </div>
                </div>
            </nav>
        @endauth

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @include('partials.cargando')
    @stack('scripts')
</body>
</html>
