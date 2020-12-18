@extends('layouts.app')

@section('content')
    @push('planeacion')
        @component('partials.menu-planeacion', ['proyecto' => $proyecto, 'idObjetivoEspecifico' => $proyecto->objetivosEspecificos->first()->id])

        @endcomponent

    @endpush
    <div class="container">
        <form action="{{ route('recursos_humanos.store', $proyecto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <agregar-personal :errors="{{ $errors }}"></agregar-personal>

            <div class="row mb-0">
                <div class="col-md-9 offset-md-3">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
