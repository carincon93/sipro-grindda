<div class="flex-column nav-pills panel-izq panel-evaluacion" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="overflow: auto;">
    @foreach ($criterios as $key => $criterio)
        <a href="{{ route('evaluacion.evaluacionFinal', [$proyecto->id, $criterio->slug]) }}" class="nav-link {{ Request::is("panel/evaluacion/{$proyecto->id}/evaluacion_final/{$criterio->slug}") ? 'active' : '' }}"><i class="fas fa-check"></i> Evaluar {{ $criterio->nombreCriterio }}</a>
    @endforeach
    @can ('descargar-evaluacion', $proyecto)
        <a href="{{ route('evaluacion.descargarExcelEvaluacion', $proyecto->id) }}" class="nav-link background-success text-success">Descargar excel</a>
    @else
        <a href="#" class="nav-link disabled">Descargar excel</a>
    @endcan
</div>
