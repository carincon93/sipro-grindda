<div class="dropdown acciones">
    <button class="btn btn-transparent btn-sm dropdown-toggle" type="button" id="acciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Acciones
    </button>
    <div class="dropdown-menu" aria-labelledby="acciones">
        @can ('editar-proyecto', $proyecto)
            <a href="{{ route('proyectos.edit', $proyecto->id) }}" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Editar proyecto</a>
        @endcan

        <a href="{{ route('proyectos.pdf', $proyecto->id) }}" class="dropdown-item"><i class="far fa-file-pdf"></i> Descargar archivo PDF</a>

        @can ('ver-proyecto', $proyecto)
            <a href="{{ route('proyectos.show', $proyecto->id) }}" class="dropdown-item"><i class="fas fa-eye"></i> Ver información</a>
            <a href="{{ route('resultados.show', [$proyecto->id, $proyecto->objetivosEspecificos->first()->id]) }}" class="dropdown-item"><i class="fas fa-external-link-alt"></i> Ir a la planeación</a>
        @endcan

        @can('evaluar-proyecto', $proyecto)
            <a href="{{ route('proyectos.evaluar', $proyecto->id) }}" class="dropdown-item"><i class="fas fa-clipboard-check"></i> Evaluar proyecto</a>
        @endcan

        @can ('enviar-proyecto-evaluacion', $proyecto)
            <div class="dropdown-submenu dropdown-item p-0">
                <button class="btn btn-transparent p-0" type="button"><i class="far fa-paper-plane"></i> Enviar a evaluación</button>
                <ul class="dropdown-menu p-0 position-relative">
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
            </div>
        @endcan
        <div class="dropdown-divider"></div>
        @can ('eliminar-proyecto', $proyecto)
            <div class="dropdown-submenu dropdown-item p-0">
                <button class="btn btn-transparent p-0" type="button"><i class="fas fa-times"></i> Eliminar</button>
                <ul class="dropdown-menu p-0 position-relative">
                    <li class="dropdown-item p-0">
                        <form action="{{ route('proyectos.destroy', $proyecto->id)}}" method="POST" class="d-block form-destroy">
                            @method('delete')
                            @csrf

                            <button type="submit" class="btn btn-danger">Confirmar</button>
                        </form>
                    </li>
                </ul>
            </div>
        @endcan

    </div>
</div>
