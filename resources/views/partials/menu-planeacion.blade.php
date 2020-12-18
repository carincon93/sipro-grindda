<li class="nav-item">
    <a class="nav-link" href="{{ route('proyectos.index', $proyecto->id) }}">Salir</a>
</li>
<li class="nav-item">
    <a class="nav-link {{ Request::is("panel/ver_planeacion/{$proyecto->id}/resultados*") ? 'active' : '' }}" href="{{ route('resultados.show', [$proyecto->id, $idObjetivoEspecifico]) }}">Resultados</a>
</li>
<li class="nav-item">
    <a class="nav-link {{ Request::is("panel/ver_planeacion/{$proyecto->id}/productos*") ? 'active' : '' }}" href="{{ route('productos.show', [$proyecto->id, $idObjetivoEspecifico]) }}">Productos</a>
</li>
<li class="nav-item">
    <a class="nav-link {{ Request::is("panel/ver_planeacion/{$proyecto->id}/actividades*") ? 'active' : '' }}" href="{{ route('actividades.show', [$proyecto->id, $idObjetivoEspecifico]) }}">Actividades</a>
</li>
<li class="nav-item">
    <a class="nav-link {{ Request::is("panel/ver_planeacion/{$proyecto->id}/recursos_humanos*") ? 'active' : '' }}" href="{{ route('recursos_humanos.index', $proyecto->id) }}">Recursos humanos</a>
</li>
{{-- <li class="nav-item">
    <a class="nav-link {{ Request::is("panel/ver_planeacion/{$proyecto->id}/actividades/diagrama") ? 'active' : '' }}" href="{{ route('actividades.diagrama', $proyecto->id) }}">Diagrama</a>
</li> --}}
<li class="nav-item dropdown">
    <a id="navbarDropdownProyectos" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gestión</a>
    <div aria-labelledby="navbarDropdownProyectos" class="dropdown-menu">
        <div>
            <a class="dropdown-item" href="{{ route('presupuestos_sennova.index', $proyecto->id) }}">Presupuestos SENNOVA</a>
        </div>
        <div class="dropdown-divider"></div>
        <div>
            <a class="dropdown-item" href="{{ route('aliados.index', $proyecto->id) }}">Alianzas empresariales</a>
        </div>
        <div>
            <a class="dropdown-item" href="{{ route('presupuestos_empresariales.index', $proyecto->id) }}">Presupuestos empresariales</a>
        </div>
        @can ('enviar-proyecto-evaluacion', $proyecto)
            <div class="dropdown-divider"></div>
            <div>
                <a href="#" class="dropdown-submenu dropdown-item">
                    <button class="btn btn-transparent p-0" type="button">Enviar a evaluación</button>
                    <ul class="dropdown-menu p-0">
                        <li class="dropdown-item p-0">
                            @if ($proyecto->evaluado)
                                <form action="{{ route('proyectos.enviarCorrecion', $proyecto->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf

                                    <button type="submit" class="btn btn-success">Confirmar</button>
                                </form>
                            @else
                                <form action="{{ route('proyectos.enviarAEvaluacion', $proyecto->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf

                                    <button type="submit" class="btn btn-success">Confirmar</button>
                                </form>
                            @endif
                        </li>
                    </ul>
                </a>
            </div>
        @endcan
    </div>
</li>
{{ $slot }}
