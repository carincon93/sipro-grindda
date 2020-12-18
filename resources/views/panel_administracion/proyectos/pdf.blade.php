<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIPRO') }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <style media="screen">
    html {
        margin: 0;
    }
    body {
        background-color: #fff;
        font-family: Arial, serif;
        margin: 2.5cm 3cm;
        text-align: justify;
    }
    </style>
</head>
<body class="body-pdf">
    <div id="app">
        <div>
            <div>
                <p>
                    Fecha de formulación: {{  date('d-m-Y', strtotime($proyecto->created_at)) }}
                    <span class="codigo" style="margin-left: 70px; display: inline-block;">Código: {{ $proyecto->codigo }}</span>
                </p>
            </div>

            <div style="margin: 240px 0px 0px 0px;">
                <h1 class="text-center">{{ $proyecto->titulo }}</h1>
                <div class="text-center" style="margin: 180px 0px 40px 0px;">
                    <span>Autores del proyecto</span>
                    @foreach ($proyecto->autores as $key => $coautor)
                        <p class="mb-0">{{ $coautor->nombre }}</p>
                        <p class="mb-0">{{ $coautor->tipoDocumento .' '. $coautor->numeroDocumento }}</p>
                    @endforeach
                </div>
            </div>

            <div>
                <h3 class="mt-5">Generalidades del centro de formación</h3>
                <p><strong>Centro de formación: </strong>{{ $proyecto->centroFormacion->nombreCentroFormacion }}</p>
                <p><strong>Regional: </strong>{{ $proyecto->centroFormacion->regional }}</p>
                <p><strong>Subdirector: </strong>{{ $proyecto->centroFormacion->nombreSubdirector }}</p>
                <p><strong>Correo electrónico del subdirector: </strong>{{ $proyecto->centroFormacion->correoElectronicoSubdirector }}</p>
                <p><strong>Celular del subdirector: </strong>{{ $proyecto->centroFormacion->numeroCelularSubdirector }}</p>
                <p><strong>Líder SENNOVA: </strong>{{ $proyecto->centroFormacion->nombreLiderSennova }}</p>
                <p><strong>Número celular del líder SENNOVA: </strong>{{ $proyecto->centroFormacion->numeroCelularLiderSennova }}
                <p><strong>Correo electrónico del líder SENNOVA: </strong>{{ $proyecto->centroFormacion->correoElectronicoLiderSennova }}</p>
            </div>

            <div>
                <h3 class="mt-5">Información básica</h3>
                <p><strong>Tipo de proyecto: </strong>{{ $proyecto->tipoProyecto }}</p>
                <p>
                    <strong>Fecha de inicio: </strong>{{ date('d-m-Y', strtotime($proyecto->fechaInicioProyecto)) }}
                </p>
                <p>
                    <strong>Fecha de fin: </strong>{{  date('d-m-Y', strtotime($proyecto->fechaFinProyecto)) }}
                </p>

                <p><strong>Área(s) de conocimiento: </strong></p>
                <ul>
                    <li>{{ $proyecto->areaConocimiento1 }}</li>
                    @isset($proyecto->areaConocimiento2)
                        <li>{{ $proyecto->areaConocimiento2 }}</li>
                    @endisset
                </ul>

                @isset($proyecto->grupoInvestigacion->nombre)
                    <p><strong>Grupo de investigación: </strong>{{ $proyecto->grupoInvestigacion->nombre }}</p>
                @endisset

                @isset($proyecto->codigoGruplac)
                    <p><strong>Código Gruplac: </strong>{{ $proyecto->codigoGruplac }}</p>
                @endisset

                <p><strong>Semilleros beneficiados</strong></p>
                <ul>
                    @foreach ($proyecto->semilleros as $key => $semillero)
                        <li>{{ $semillero->nombre }}</li>
                    @endforeach
                </ul>

                <p><strong>Programas de formación beneficiados</strong></p>
                <ul>
                    @forelse ($proyecto->programasFormacion as $key => $programaFormacion)
                        <li>{{ $programaFormacion->nombre }}</li>
                    @empty
                        <li>No hay programas de formación beneficiados</li>
                    @endforelse
                </ul>
            </div>

            <div>
                <div>
                    <h3 class="mt-5">Antecedentes y justificación del proyecto</h3>
                    <p>{{ $proyecto->antecedentesJustificacionProyecto }}</p>
                </div>

                <div>
                    <h3 class="mt-5">Planteamiento del problema</h3>
                    <p>{{ $proyecto->planteamientoProblema }}</p>
                </div>

                <div>
                    <h3 class="mt-5">Objetivo general</h3>
                    <p>{{ $proyecto->objetivoGeneral }}</p>
                </div>

                @foreach ($proyecto->objetivosEspecificos as $key => $objetivoEspecifico)
                    <div style="margin: 75px 0px;">
                        <h3>Objetivo específico {{ $key + 1 }}</h3>
                        <p>{{ $objetivoEspecifico->descripcion }}</p>

                        <ul>
                            <li><h5>Resultado</h5></li>
                            @foreach ($objetivoEspecifico->resultados as $key => $resultado)
                                    <p><strong>Descripción: </strong>{{ $resultado->descripcion }}</p>
                                    <p><strong>Indicador: </strong>{{ $resultado->indicador }}</p>
                                    <p><strong>Medio de verificación: </strong>{{ $resultado->medioVerificacion }}</p>
                                    <p><strong>Meta: </strong>{{ $resultado->meta }}</p>

                                @forelse ($resultado->productos as $key => $producto)
                                    <li><h5 class="mt-5">Producto</h5></li>

                                        {{-- <p>{{ $producto->codigo }}</p> --}}
                                    <p><strong>Descripción: </strong>{{ $producto->descripcion }}</p>
                                    <p><strong>Fecha de inicio: </strong>{{  date('d-m-Y', strtotime($producto->fechaInicio)) }}</p>
                                    <p><strong>Fecha de fin: </strong>{{  date('d-m-Y', strtotime($producto->fechaFin)) }}</p>
                                    <p><strong>Duración: </strong>{{ $producto->duracion }} mes(es)</p>


                                    <div>
                                        <p><strong>Actividades: </strong></p>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Descripción</th>
                                                    <th>Fecha de inico</th>
                                                    <th>Fecha de fin</th>
                                                    <th>Duración</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($producto->actividades as $key => $actividad)
                                                    <tr>
                                                        <td>{{ $actividad->descripcion }}</td>
                                                        <td>{{  date('d-m-Y', strtotime($actividad->fechaInicio)) }}</td>
                                                        <td>{{  date('d-m-Y', strtotime($actividad->fechaFin)) }}</td>
                                                        <td>{{  $actividad->duracion }} días</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4">No hay actividades registradas</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                @empty
                                    <p>No hay productos registrados</p>
                                @endforelse
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>


            <div>
                <h3>Impactos</h3>
                <p><strong>Impacto social: </strong>{{ $proyecto->impactoSocial }}</p>
                <p><strong>Impacto económico: </strong>{{ $proyecto->impactoEconomico }}</p>
                <p><strong>Impacto tecnológico: </strong>{{ $proyecto->impactoTecnologico }}</p>
                <p><strong>Impacto ambiental: </strong>{{ $proyecto->impactoAmbiental }}</p>
            </div>

            @if ($proyecto->aplicacionPosconflicto == 'si')
                <div>
                    <h3 class="mt-5">Posconflicto</h3>
                    <p><strong>Municipios a impactar: </strong>{{ $proyecto->municipiosAImpactar }}</p>
                    <p><strong>Descripción de la estratégia: </strong>{{ $proyecto->descripcionEstrategia }}</p>
                    <p><strong>Recursos posconflicto (COP): </strong>$ {{ number_format($proyecto->recursosPosconflicto, 0, ',', '.') }}</p>
                </div>
            @endif

            <div>
                <h3 class="mt-5">Recursos humanos</h3>
                @forelse ($proyecto->recursosHumanos as $key => $recursosHumanos)
                    <ul>
                        @if ($recursosHumanos->personalInterno == true)
                            <li>
                                <h5>Personal interno</h5>
                                <p class="mb-0"><strong>Nombre: </strong>{{ $recursosHumanos->nombrePersonal }}</p>
                                <p><strong>Número de documento: </strong>{{ $recursosHumanos->numeroDocumentoPersonal }}</p>
                            </li>

                        @elseif ($recursosHumanos->personalInstructor == true)
                            <li>
                                <h5>Personal instructor</h5>
                                <p class="mb-0"><strong>Nombre: </strong>{{ $recursosHumanos->nombrePersonal }}</p>
                                <p><strong>Número de documento: </strong>{{ $recursosHumanos->numeroDocumentoPersonal }}</p>
                            </li>
                        @endif
                    </ul>
                @empty
                    <p>No hay personal interno y/o instuctor asociados</p>
                @endforelse
            </div>

            <div>
                <h3 class="mt-5 mb-4">Presupuesto SENNOVA</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre del rubro</th>
                            <th>Valor</th>
                            <th style="width: 50%;">Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($proyecto->presupuestos as $key => $presupuesto)
                            <tr>
                                <td>{{ $presupuesto->nombreItem }}</td>
                                <td>$ {{ number_format($presupuesto->valor, 0, ',', '.') }}</td>
                                <td>{{ $presupuesto->descripcion }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No hay presupuesto SENNOVA registrado</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            @isset($presupuesto)
                                <td colspan="3"><strong>Total: </strong>$ {{ number_format($presupuesto->totalPresupuesto($proyecto->id), 0, ',', '.') }}</td>
                            @endisset
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div>
                <h3 class="mt-5">Aliados empresariales</h3>
                @forelse ($proyecto->aliados as $key => $aliado)
                    <p><strong>Nombre del aliado: </strong>{{ $aliado->nombreAliado }}</p>
                    <ul>
                        <li><strong>NIT: </strong>{{ $aliado->nit }}</li>
                        <li><strong>Nombre del contácto: </strong>{{ $aliado->nombre }}</li>
                        <li><strong>Número de celular del cóntacto: </strong>{{ $aliado->celular }}</li>
                        <li><strong>Recuros en especie (COP): </strong>$ {{ number_format($aliado->recursosEspecie, 0, ',', '.') }}</li>
                        <li><strong>Recursos en dinero (COP): </strong>$ {{ number_format($aliado->recursosDinero, 0, ',', '.') }}</li>
                        <li><strong>Ciudades y/o municipios de influencia: </strong>{{ $aliado->ciudadesMunicipiosInfluencia }}</li>
                    </ul>

                    <h3 class="mt-5 mb-4">Presupuesto empresarial</h3>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre del rubro</th>
                                <th>Valor</th>
                                <th style="width: 50%;">Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($aliado->presupuestosEmpresariales as $presupuestoEmpresarial)
                                <tr>
                                    <td>{{ $presupuestoEmpresarial->nombreItem }}</td>
                                    <td>$ {{ number_format($presupuestoEmpresarial->valor, 0, ',', '.') }}</td>
                                    <td>{{ $presupuestoEmpresarial->descripcion }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No hay presupuesto asociado a esta alianza</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            @isset($presupuestoEmpresarial)
                                <tr>
                                    <td colspan="3"><strong>Total: </strong>$ {{ number_format($presupuestoEmpresarial->totalPresupuesto($aliado->id), 0, ',', '.') }}</td>
                                </tr>
                            @endisset
                        </tfoot>
                    </table>
                @empty
                    <p>No hay aliado empresariales asociados</p>
                @endforelse
            </div>
        </div>
    </div>
</body>
</html>
