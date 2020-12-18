@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <h2 class="text-center">Bienvenido {{ auth()->user()->nombre }}</h2>
        <h3 class="text-center">¿Desea formular un proyecto?</h3>

        <div class="d-flex justify-content-center">
            <a href="{{ route('proyectos.create') }}" class="btn btn-primary mt-5">Formular proyecto</a>
        </div> --}}
        <div class="row d-flex justify-content-center">
            <div class="col-md-4">
                <div class="card"></div>
            </div>
        </div>
    </div>
@endsection
