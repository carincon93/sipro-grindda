@extends('layouts.app')

@section('content')
    @push('planeacion')
        @component('partials.menu-planeacion', ['proyecto' => $proyecto, 'idObjetivoEspecifico' => $proyecto->objetivosEspecificos->first()->id])

        @endcomponent

    @endpush
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h4>Presupuesto SENNOVA</h4>
            </div>
            <div class="col-md-7">
                <form action="{{ route('presupuestos_sennova.store', $proyecto->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <presupuesto :errors="{{$errors}}" :tipopresupuesto="'Presupuesto SENNOVA'"></presupuesto>
                    <button type="submit" class="btn btn-primary">Generar presupuesto</button>
                </form>
            </div>
        </div>
    </div>
@endsection
