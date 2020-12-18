<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PaginaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\PresupuestoEmpresarialController;
use App\Http\Controllers\RecursoHumanoController;
use App\Http\Controllers\AliadoController;
use App\Http\Controllers\ResultadoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ActividadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('panel')->group(function () {

        Route::get('/', function() {
            return redirect()->route('proyectos.index');
        });

        Route::get('/descargar_borrador/{nombreArchivo}', [PaginaController::class, 'descargarBorrador'])->name('archivos.borrador');

        // Notificaciones
        Route::get('/obtener_notificaciones/{id}', [UserController::class, 'obtenerNotificaciones']);
        Route::get('/marcar_notificacion/{id}', [UserController::class, 'marcarNotificacion']);

        Route::get('/proyectos/grupo_investigacion/{grupoInvestigacion}', [ProyectoController::class, 'listarProyectosGrupoInvestigacion'])->name('proyectos.grupoInvestigacion');
        Route::get('/proyectos_semilleros', [ProyectoController::class, 'listarSemilleros'])->name('proyectos.semilleros');
        Route::get('/proyectos_formativos', [ProyectoController::class, 'listarProyectosFormativos'])->name('proyectos.formativos');
        Route::get('/proyectos_priorizados', [ProyectoController::class, 'listarProyectosPriorizados'])->name('proyectos.priorizados');
        Route::get('/proyectos/semillero/{nombre}', [ProyectoController::class, 'mostrarProyectosSemilleros'])->name('semilleros.proyectos');
        Route::get('/proyectos/{idProyecto}/pdf', [ProyectoController::class, 'pdf'])->name('proyectos.pdf');
        // Modificar objetivos específicos - Ajax
        Route::post('/proyectos/objetivo_especifico/crear', [ProyectoController::class, 'agregarObjetivoEspecifico']);
        Route::post('/proyectos/objetivo_especifico/editar', [ProyectoController::class, 'modificarObjetivoEspecifico']);
        Route::delete('/proyectos/objetivo_especifico/{idObjetivoEspecifico}', [ProyectoController::class, 'eliminarObjetivoEspecifico'])->name('proyectos.eliminarObjetivoEspecifico');
        // Enviar proyecto a evaluación por parte de los autores
        Route::put('/proyectos/{idProyecto}/enviar_proyecto', [ProyectoController::class, 'enviarProyectoAEvaluacion'])->name('proyectos.enviarAEvaluacion');
        // Enviar proyecto a corrección
        Route::put('/proyectos/{idProyecto}/correccion_evaluacion', [ProyectoController::class, 'enviarCorrecionProyecto'])->name('proyectos.enviarCorrecion');
        // Guardar estado Viable - No viable
        Route::put('/proyectos/{idProyecto}/guardar_estado', [ProyectoController::class, 'guardarEstado'])->name('proyectos.guardarEstado');

        // Crear proyecto - Obtener co-autores
        Route::get('/obtener_coautores', [UserController::class, 'obtenerCoAutores']);

        Route::prefix('evaluacion')->group(function () {
            // *********************
            // Sistema de evaluación
            // *********************
            Route::get('/{idProyecto}/evaluacion_tecnica/evaluacion_informacion_principal', [EvaluacionController::class, 'formularioEvaluacion'])->name('proyectos.evaluar');
            Route::post('/{idProyecto}/evaluacion_tecnica/evaluacion_informacion_principal', [EvaluacionController::class, 'guardarEvaluacion'])->name('proyectos.guardarEvaluacion');
            // Descargar carta de compromiso del instructor - evaluación
            Route::get('/carta/{nombreInstructor}/{nombrePersonal}', [EvaluacionController::class, 'descargarCartaCompromiso'])->name('evaluacion.descargarCartaCompromiso');
            // Evaluación de resultados
            Route::get('/{idProyecto}/evaluacion_tecnica/evaluacion_resultados', [EvaluacionController::class, 'formularioEvaluacionResultado'])->name('evaluacion.evaluarResultados');
            Route::post('/{idProyecto}/evaluacion_tecnica/evaluacion_resultados', [EvaluacionController::class, 'guardarEvaluacionResultado'])->name('evaluacion.guardarEvaluacionResultados');
            // Evaluación de productos
            Route::get('/{idProyecto}/evaluacion_tecnica/evaluacion_productos', [EvaluacionController::class, 'formularioEvaluacionProducto'])->name('evaluacion.evaluarProductos');
            Route::post('/{idProyecto}/evaluacion_tecnica/evaluacion_productos', [EvaluacionController::class, 'guardarEvaluacionProducto'])->name('evaluacion.guardarEvaluacionProductos');
            // Evaluación de aliados
            Route::get('/{idProyecto}/evaluacion_tecnica/evaluacion_aliados', [EvaluacionController::class, 'formularioEvaluacionAliado'])->name('evaluacion.evaluarAliados');
            Route::post('/{idProyecto}/evaluacion_tecnica/evaluacion_aliados', [EvaluacionController::class, 'guardarEvaluacionAliado'])->name('evaluacion.guardarEvaluacionAliados');

            // Evaluación de presupuesto SENNOVA
            Route::get('/{idProyecto}/evaluacion_tecnica/evaluacion_presupuesto_sennova', [EvaluacionController::class, 'formularioEvaluacionPresupuestoSENNOVA'])->name('evaluacion.evaluarPresupuestoSENNOVA');
            Route::post('/{idProyecto}/evaluacion_tecnica/evaluacion_presupuesto_sennova', [EvaluacionController::class, 'guardarEvaluacionPresupuestoSENNOVA'])->name('evaluacion.guardarEvaluacionPresupuestoSENNOVA');
            // Evaluación de actividad
            Route::get('/{idProyecto}/evaluacion_tecnica/evaluacion_actividad', [EvaluacionController::class, 'formularioEvaluacionActividad'])->name('evaluacion.evaluarActividades');
            Route::post('/{idProyecto}/evaluacion_tecnica/evaluacion_actividad', [EvaluacionController::class, 'guardarEvaluacionActividad'])->name('evaluacion.guardarEvaluacionActividades');
            // Evaluación de recursos humanos
            Route::get('/{idProyecto}/evaluacion_tecnica/evaluacion_recursos_humanos', [EvaluacionController::class, 'formularioEvaluacionRecursoHumano'])->name('evaluacion.evaluarRecursosHumanos');
            Route::post('/{idProyecto}/evaluacion_tecnica/evaluacion_recursos_humanos', [EvaluacionController::class, 'guardarEvaluacionRecursoHumano'])->name('evaluacion.guardarEvaluacionRecursosHumanos');
            // Evaluación de presupuestos empresariales
            Route::get('/{idProyecto}/evaluacion_tecnica/evaluacion_presupuestos_empresariales', [EvaluacionController::class, 'formularioEvaluacionPresupuestoEmpresarial'])->name('evaluacion.evaluarPresupuestoEmpresarial');
            Route::post('/{idProyecto}/evaluacion_tecnica/evaluacion_presupuestos_empresariales', [EvaluacionController::class, 'guardarEvaluacionPresupuestoEmpresarial'])->name('evaluacion.guardarEvaluacionPresupuestoEmpresarial');
            // Evaluación de pertinencia
            Route::get('/{idProyecto}/evaluacion_pertinencia', [EvaluacionController::class, 'formularioEvaluacionPertinencia'])->name('evaluacion.evaluarPertinencia');
            Route::put('/{idProyecto}/evaluacion_pertinencia', [EvaluacionController::class, 'guardarEvaluacionPertinencia'])->name('evaluacion.guardarPertinencia');
            // Criterios de evaluacion
            Route::get('/{idProyecto}/evaluacion_final/{criterio}', [EvaluacionController::class, 'formularioCriterioEvaluacion'])->name('evaluacion.evaluacionFinal');
            Route::get('/{idProyecto}/observacion_final', [EvaluacionController::class, 'formularioObervacionFinal'])->name('evaluacion.evaluacionObservacionFinal');
            Route::post('/{idProyecto}/observacion_final', [EvaluacionController::class, 'guardarEvaluacionObservacionFinal'])->name('evaluacion.guardarEvaluacionObservacionFinal');

            Route::post('/{idProyecto}/evaluacion_final', [EvaluacionController::class, 'guardarEvaluacionCriterio'])->name('evaluacion.guardarEvaluacionCriterio');


            // Enviar evaluación
            // Route::put('/{idProyecto}/evaluacion', [ProyectoController::class, 'enviarEvaluacion'])->name('proyectos.enviarEvaluacion');
            Route::get('/{idProyecto}/evaluacion_tecnica/enviar_evaluacion', [EvaluacionController::class, 'formularioEnviarEvaluacion'])->name('evaluacion.enviarEvaluacion');
            Route::put('/{idProyecto}/evaluacion_tecnica/enviar_evaluacion', [EvaluacionController::class, 'enviarEvaluacion'])->name('evaluacion.guardarEvaluacion');

            Route::get('/{idProyecto}/descargar_excel', [EvaluacionController::class, 'descargarExcel'])->name('evaluacion.descargarExcelEvaluacion');
        });

        // CAJA DE IDEAS
        Route::resource('/logos_aliados', 'LogoAliadoController');
        Route::resource('/caja_ideas', 'IdeaEmpresaController');

        Route::prefix('ver_planeacion')->group(function () {
            // CRUD => PRESUPUESTOS
            Route::get('/{idProyecto}/presupuestos_sennova/descargar_carta_presupuesto', [PresupuestoController::class, 'descargarCartaPresupuesto'])->name('presupuestos_sennova.descargarCartaPresupuesto');
            Route::resource('/{idProyecto}/presupuestos_sennova', 'PresupuestoController');
            // CRUD => PRESUPUESTOS EMPRESARIALES
            Route::get('/{idProyecto}/presupuestos_empresariales/{idAliado}/crear', [PresupuestoEmpresarialController::class, 'create'])->name('presupuestos_empresariales.createPresupuestoEmpresarial');
            Route::get('/{idProyecto}/presupuestos_empresariales/descargar_carta_presupuesto', [PresupuestoEmpresarialController::class, 'descargarCartaPresupuesto'])->name('presupuestos_empresariales.descargarCartaPresupuesto');
            Route::resource('/{idProyecto}/presupuestos_empresariales', 'PresupuestoEmpresarialController');
            // CRUD => RECURSOS HUMANOS
            Route::get('/{idProyecto}/recursos_humanos/descargar_carta_presupuesto', [RecursoHumanoController::class, 'descargarCartaCompromiso'])->name('recursos_humanos.descargarCartaCompromiso');
            Route::resource('/{idProyecto}/recursos_humanos', 'RecursoHumanoController');
            // CRUD => ALIADOS
            Route::get('/aliados/{idAliado}/descargar_carta_convenio', [AliadoController::class, 'descargarCartaConvenio'])->name('aliados.descargarCartaConvenio');
            Route::resource('/{idProyecto}/aliados', 'AliadoController');

            // CRUD => RESULTADOS
            Route::get('/{idProyecto}/resultados', [ResultadoController::class, 'index'])->name('resultados.index');
            Route::get('/{idProyecto}/resultados/{idObjetivoEspecifico}/crear', [ResultadoController::class, 'create'])->name('resultados.create');
            Route::post('/{idProyecto}/resultados/{idObjetivoEspecifico}', [ResultadoController::class, 'store'])->name('resultados.store');
            Route::get('/{idProyecto}/resultados/{idObjetivoEspecifico}', [ResultadoController::class, 'show'])->name('resultados.show');

            Route::get('/{idProyecto}/resultados/{idResultado}/editar', [ResultadoController::class, 'edit'])->name('resultados.edit');
            Route::put('/{idProyecto}/resultados/{idResultado}', [ResultadoController::class, 'update'])->name('resultados.update');
            Route::delete('/{idProyecto}/resultados/{idResultado}', [ResultadoController::class, 'destroy'])->name('resultados.destroy');
            // Route::resource('/{idProyecto}/resultados', 'ResultadoController');
            // CRUD => PRODUCTOS
            Route::get('/{idProyecto}/productos', [ProductoController::class, 'index'])->name('productos.index');
            Route::get('/{idProyecto}/productos/{idResultado}/crear/{nroProducto}', [ProductoController::class, 'create'])->where('nroProducto', '[1-4]')->name('productos.create');
            Route::post('/{idProyecto}/productos/{idResultado}', [ProductoController::class, 'store'])->name('productos.store');
            Route::get('/{idProyecto}/productos/{idObjetivoEspecifico}', [ProductoController::class, 'show'])->name('productos.show');

            Route::get('/{idProyecto}/productos/{idProducto}/editar', [ProductoController::class, 'edit'])->name('productos.edit');
            Route::put('/{idProyecto}/productos/{idProducto}', [ProductoController::class, 'update'])->name('productos.update');
            Route::delete('/{idProyecto}/productos/{idProducto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
            // Route::resource('/{idProyecto}/productos', 'ProductoController');
            // CRUD => ACTIVIDADES
            Route::get('/{idProyecto}/actividades', [ActividadController::class, 'index'])->name('actividades.index');
            Route::get('/{idProyecto}/actividades/diagrama', [ActividadController::class, 'diagrama'])->name('actividades.diagrama');
            Route::get('/{idProyecto}/actividades/{idProducto}/crear/{nroActividad}', [ActividadController::class, 'create'])->where('nroActividad', '[1-4]')->name('actividades.create');
            Route::post('/{idProyecto}/actividades/{idProducto}', [ActividadController::class, 'store'])->name('actividades.store');
            Route::get('/{idProyecto}/actividades/{idObjetivoEspecifico}', [ActividadController::class, 'show'])->name('actividades.show');

            Route::get('/{idProyecto}/actividades/{idActividad}/editar', [ActividadController::class, 'edit'])->name('actividades.edit');
            Route::put('/{idProyecto}/actividades/{idActividad}', [ActividadController::class, 'update'])->name('actividades.update');
            Route::delete('/{idProyecto}/actividades/{idActividad}', [ActividadController::class, 'destroy'])->name('actividades.destroy');
            // Route::resource('/ver_planeacion/{idProyecto}/actividades', 'ActividadController');
        });

        // Obtener actividades por ajax - modal diagrama
        Route::get('/obtener_actividad', [ActividadController::class, 'obtenerActividad']);
        // Listar aprendices
        Route::get('/usuarios/aprendices', [UserController::class, 'listarAprendices'])->name('usuarios.aprendices');
        Route::get('/usuarios/descargar_excel/{tipoRol}', [UserController::class, 'descargarExcelUsuarios'])->name('usuarios.descargarExcelUsuarios');

        // CRUD
        Route::resources([
            '/usuarios'             => UserController::class,
            '/roles'                => RolController::class,
            '/proyectos'            => ProyectoController::class,
            '/semilleros'           => SemilleroController::class,
            '/centros_formacion'    => CentroFormacionController::class,
            '/areas_conocimiento'   => AreaConocimientoController::class,
            '/programas_formacion'  => ProgramaFormacionController::class,
            '/grupos_investigacion' => GrupoInvestigacionController::class,
            '/lineas_investigacion' => LineaInvestigacionController::class,
            '/convocatorias'        => ConvocatoriaController::class,
        ]);
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
