<hr>
<table class="table table-custom dataTable table-proyectos" data-page-length="50">
    <thead>
        <tr>
            <th>Título del proyecto</th>
            <th>Estado</th>
            <th style="width: 10%">Viabilidad</th>
            <th style="width: 20%">Fecha de creación</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($proyectos as $proyecto)
            <tr>
                <td>
                    @can ('generar-planeacion', $proyecto)
                        @if($proyecto->evaluado == true)
                            <span class="badge badge-danger">El proyecto ha sido evaluado! <a href="{{ route('proyectos.show', $proyecto->id) }}" class="text-light"><u>Mira si tiene recomendaciones</u></a></span>
                        @endif
                    @endcan
                    <p>{{ $proyecto->titulo }}</p>
                    <p class="text-muted border-top text-capitalize">
                        Autor(es):
                        @foreach ($proyecto->autores as $autor)
                            {{ $autor->nombre }},
                        @endforeach
                    </p>
                </td>
                <td class="estado">
                    @if($proyecto->modificado == true && $proyecto->enviado == true && $proyecto->evaluado == true && $proyecto->estado != null)
                        <span class="badge">Con evaluación final</span>
                    @elseif($proyecto->modificado == true && $proyecto->enviado == true && $proyecto->evaluado == true)
                        <span class="badge badge-success">Corregido y enviado</span>
                    @elseif($proyecto->evaluado == true)
                        <span class="badge badge-danger">Evaluado</span>
                    @elseif($proyecto->modificado == true)
                        <span class="badge badge-success">Modificado</span>
                    @elseif ($proyecto->enviado == true)
                        <span class="badge badge-info">Enviado</span>
                    @else
                        <span class="badge badge-secondary">En formulación</span>
                    @endif
                </td>
                <td>
                    <span class="small">{{ number_format($proyecto->estado, 2, '.', ',').' %' }}</span>
                    @if ($proyecto->estado > 80)
                        <span class="badge badge-success">Viable</span>
                    @endif
                </td>
                <td class="fecha">{{ $proyecto->created_at }}</td>
                <td>
                    @include('partials.dropdown-acciones')
                </td>
            </tr>
        @empty

        @endforelse
    </tbody>
</table>
