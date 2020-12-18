<li class="nav-item">
    <a href="{{ route('proyectos.index', $proyecto->id) }}" class="nav-link">Salir</a>
</li>
<li class="nav-item">
    <a href="{{ route('proyectos.evaluar', $proyecto->id) }}" class="nav-link {{ Request::is("panel/evaluacion/{$proyecto->id}/evaluacion_tecnica*") ? 'active' : '' }}">Evaluación técnica</a>
</li>
<li class="nav-item">
    <a href="{{ route('evaluacion.evaluarPertinencia', $proyecto->id) }}" class="nav-link {{ Request::is("panel/evaluacion/{$proyecto->id}/evaluacion_pertinencia") ? 'active' : '' }}">Evaluar pertinencia</a>
</li>
<li class="nav-item">
    <a href="{{ route('evaluacion.evaluacionFinal', [$proyecto->id, 'titulo']) }}" class="nav-link {{ Request::is("panel/evaluacion/{$proyecto->id}/evaluacion_final*") ? 'active' : '' }}">Evaluación final</a>
</li>
