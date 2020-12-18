@extends('layouts.app')

@section('body_class', 'panel-planeacion')

@section('content')
    @push('planeacion')
        @component('partials.menu-planeacion', ['proyecto' => $proyecto, 'idObjetivoEspecifico' => $proyecto->objetivosEspecificos->first()->id])

        @endcomponent
    @endpush
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>
        <div class="jumbotron pt-4 pb-1">
            <h1 class="display-6">Diagrama de Gantt</h1>
            <div class="row">
                <div class="col-md-6">
                    <p class="lead">En el siguiente diagrama visualizarás el tiempo de dedicación previsto a cada actividad.</p>
                    <figure>
                        <img src="{{ asset('images/diagrama.png') }}" alt="" class="img-fluid">
                    </figure>
                </div>
                <div class="col-md-6">
                    <p class="lead">Da click en las barras azules o en el código para visualizar la información de esa actividad.</p>
                    <figure>
                        <img src="{{ asset('images/modal-diagrama.png') }}" alt="" class="img-fluid d-block mx-auto" width="400">
                    </figure>
                </div>
            </div>
        </div>

        <h3>Actividades</h3>

        <div id="chart_div"></div>

        <div class="modal fade" id="modalActividad" tabindex="-1" role="dialog" aria-labelledby="modalActividadLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalActividadLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <p><strong>Descripción de la actividad: </strong><span class="descripcion"></span></p>
                        </div>
                        <div>
                            <p><strong>Fecha de inicio de actividad: </strong><span class="fecha-inicio"></span></p>
                        </div>
                        <div>
                            <p><strong>Fecha de fin de actividad: </strong><span class="fecha-final"></span></p>
                        </div>
                        <div>
                            <p><strong>Cantidad de días laborales: </strong><span class="dias"></span></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    var data;
    google.charts.load('current', {'packages':['gantt'], 'language': 'es'});

    @php
    $sizeArray = 0;
    foreach ($proyecto->objetivosEspecificos as $key => $objetivoEspecifico) {
        foreach ($objetivoEspecifico->resultados as $key => $resultado) {
            foreach ($resultado->productos as $key => $producto) {
                foreach ($producto->actividades as $key => $actividad) {
                    $sizeArray += 1;
                }
            }
        }
    }
    @endphp

    @if ($sizeArray > 0)
    google.charts.setOnLoadCallback(drawChart);
    @endif

    function drawChart() {

        data = new google.visualization.DataTable();

        data.addColumn('string', 'Task ID');
        data.addColumn('string', 'Task Name');
        data.addColumn('string', 'Resource');
        data.addColumn('date', 'Start Date');
        data.addColumn('date', 'End Date');
        data.addColumn('number', 'Duration');
        data.addColumn('number', 'Percent Complete');
        data.addColumn('string', 'Dependencies');

        @foreach ($proyecto->objetivosEspecificos as $key => $objetivoEspecifico)
        @foreach ($objetivoEspecifico->resultados as $key => $resultado)
        @foreach ($resultado->productos as $key => $producto)
        @foreach ($producto->actividades as $key => $actividad)
        data.addRows([
            ['{{ $actividad->id }}', '{{ $producto->codigo.$actividad->codigo }}', '',
            new Date({{ date('Y',strtotime($actividad->fechaInicio)) }}, ({{ date('m', strtotime($actividad->fechaInicio)) }} - 1), {{ date('d',strtotime($actividad->fechaInicio)) }}), new Date({{ date('Y',strtotime($actividad->fechaFin)) }}, ({{ date('m',strtotime($actividad->fechaFin)) }} - 1), {{ date('d',strtotime($actividad->fechaFin)) }}), null, 100, null],
        ]);
        @endforeach
        @endforeach
        @endforeach
        @endforeach

        var options = {
            width: '100%',
            height: {{ ($sizeArray + 2) * 30 }},
            gantt: {
                trackHeight: 30,
                labelStyle: {
                    fontName: 'Arial',
                    fontSize: 14,
                    color: '#757575',
                }
            },
            backgroundColor: {
                fill: '#fff'
            }
        };


        chart = new google.visualization.Gantt(document.getElementById('chart_div'));

        chart.draw(data,options);

        google.visualization.events.addListener(chart, 'select', myClickHandler);

        function myClickHandler(){
            var selection = chart.getSelection();
            for (var i = 0; i < selection.length; i++) {
                var item    = selection[i];
                var id      = data.getValue(item.row, i);
            }

            $('#modalActividad').modal('show');
            obtenerActividad(id);
        }
    }

    function obtenerActividad(id) {
        $.get('/panel/obtener_actividad', {id: id}, function(data, textStatus, xhr) {
            if (data) {

                $('.descripcion').text(data.descripcion);
                $('.fecha-inicio').text(moment(data.fechaInicio).locale('es').format('LL'));
                $('.fecha-final').text(moment(data.fechaFin).locale('es').format('LL'));
                $('.dias').text(data.duracion);
                $('#modalActividadLabel').text('Actividad');
            }
        });
    }
    </script>
@endpush
