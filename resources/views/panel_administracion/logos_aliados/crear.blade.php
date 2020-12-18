@extends('layouts.app')

@section('content')
    <div class="container">

        <form action="{{ route('logos_aliados.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
                <label for="logo" class="col-md-3">Logo del aliado <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input id="logo" name="logo" type="file" class="form-control{{ $errors->has('logo') ? ' is-invalid' : '' }}" accept="image/*" required>

                    @if ($errors->has('logo'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('logo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-9 offset-md-3">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
