@extends('layouts.app')

@section('content')
    @push('planeacion')
        @component('partials.menu-planeacion', ['proyecto' => $proyecto, 'idObjetivoEspecifico' => $proyecto->objetivosEspecificos->first()->id])

        @endcomponent

    @endpush
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <p>Presupuesto del aliado empresarial</p>
                <h4>{{ $aliado->nombreAliado }}</h4>
            </div>
            <div class="col-md-7">
                <form action="{{ route('presupuestos_empresariales.store', $proyecto->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="aliadoId" value="{{ $aliado->id }}">

                    <presupuesto :errors="{{$errors}}"></presupuesto>

                    <button type="submit" class="btn btn-primary">Generar presupuesto</button>
                </div>
            </form>
        </div>
    </div>
@endsection
