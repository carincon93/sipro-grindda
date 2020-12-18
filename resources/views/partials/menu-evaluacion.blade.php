<div class="nav flex-column nav-pills panel-izq panel-evaluacion" id="v-pills-tab" role="tablist" aria-orientation="vertical">

    <a href="{{ route('proyectos.evaluar', $proyecto->id) }}" class="nav-link {{ Request::is("panel/evaluacion/{$proyecto->id}/evaluacion_tecnica/evaluacion_informacion_principal") ? 'active' : '' }} {{ $proyecto->informacionPrincipalEvaluada($proyecto, 'proyecto_id') != null ? 'evaluado' : '' }}"><i class="fas fa-check"></i> Evaluar información principal</a>

    <a href="{{ route('evaluacion.evaluarResultados', $proyecto->id) }}" class="nav-link {{ Request::is("panel/evaluacion/{$proyecto->id}/evaluacion_tecnica/evaluacion_resultados") ? 'active' : '' }} {{ $proyecto->obtenerEvaluacion($proyecto, 'resultado_id') != null ? 'evaluado' : '' }}"><i class="fas fa-check"></i> Evaluar resultados</a>

    <a href="{{ route('evaluacion.evaluarProductos', $proyecto->id) }}" class="nav-link {{ Request::is("panel/evaluacion/{$proyecto->id}/evaluacion_tecnica/evaluacion_productos") ? 'active' : '' }} {{ $proyecto->obtenerEvaluacion($proyecto, 'producto_id') != null ? 'evaluado' : '' }}"><i class="fas fa-check"></i> Evaluar productos</a>

    <a href="{{ route('evaluacion.evaluarActividades', $proyecto->id) }}" class="nav-link {{ Request::is("panel/evaluacion/{$proyecto->id}/evaluacion_tecnica/evaluacion_actividad") ? 'active' : '' }} {{ $proyecto->obtenerEvaluacion($proyecto, 'actividad_id') != null ? 'evaluado' : '' }}"><i class="fas fa-check"></i> Evaluar actividades</a>

    <a href="{{ route('evaluacion.evaluarAliados', $proyecto->id) }}" class="nav-link {{ Request::is("panel/evaluacion/{$proyecto->id}/evaluacion_tecnica/evaluacion_aliados") ? 'active' : '' }} {{ $proyecto->obtenerEvaluacion($proyecto, 'aliado_id') != null ? 'evaluado' : '' }}"><i class="fas fa-check"></i> Evaluar aliados</a>

    <a href="{{ route('evaluacion.evaluarRecursosHumanos', $proyecto->id) }}" class="nav-link {{ Request::is("panel/evaluacion/{$proyecto->id}/evaluacion_tecnica/evaluacion_recursos_humanos") ? 'active' : '' }} {{ $proyecto->obtenerEvaluacion($proyecto, 'recurso_humano_id') != null ? 'evaluado' : '' }}"><i class="fas fa-check"></i> Evaluar recursos humanos</a>

    <a href="{{ route('evaluacion.evaluarPresupuestoEmpresarial', $proyecto->id) }}" class="nav-link {{ Request::is("panel/evaluacion/{$proyecto->id}/evaluacion_tecnica/evaluacion_presupuestos_empresariales") ? 'active' : '' }} {{ $proyecto->obtenerEvaluacion($proyecto, 'presupuesto_empresarial_id') != null ? 'evaluado' : '' }}"><i class="fas fa-check"></i> Evaluar presupuesto empresarial</a>

    <a href="{{ route('evaluacion.evaluarPresupuestoSENNOVA', $proyecto->id) }}" class="nav-link {{ Request::is("panel/evaluacion/{$proyecto->id}/evaluacion_tecnica/evaluacion_presupuesto_sennova") ? 'active' : '' }} {{ $proyecto->obtenerEvaluacion($proyecto, 'presupuesto_id') != null ? 'evaluado' : '' }}"><i class="fas fa-check"></i> Evaluar presupuesto SENNOVA</a>

    <a href="{{ route('evaluacion.enviarEvaluacion', $proyecto->id) }}" class="nav-link {{ Request::is("panel/evaluacion/{$proyecto->id}/evaluacion_tecnica/enviar_evaluacion") ? 'active' : '' }} {{ $proyecto->obtenerEvaluacionEnviada($proyecto) != null ? 'evaluado' : '' }}"><i class="fas fa-check"></i> Enviar evaluación</a>

</div>
