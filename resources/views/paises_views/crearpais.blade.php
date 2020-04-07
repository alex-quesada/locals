@extends('master');

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        @if ($errors->first('nombrePais') || $errors->first('continentePais') || $errors->first('codigoTelefono') )
        <div class="alert alert-danger">
            <strong>Campos en blanco, intente nuevamente...</strong>
        </div>
        @endif
        @if ($message = Session::get('danger'))
        <div class="alert alert-danger">
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <form action="{{ action('PaisController@store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombrePais">Nombre País</label>
                <input class="form-control" id="nombrePais" type="text" name="nombrePais"
                    value="{{ old('nombrePais') }}" placeholder="Ingrese Nombre País...">
            </div>
            <div class="form-group">
                <label for="continentePais">Continente País</label>
                <input class="form-control" id="continentePais" type="text" name="continentePais"
                    value="{{ old('continentePais') }}" placeholder="Ingrese Continente País...">
            </div>
            <div class="form-group">
                <label for="codigoTelefono">Codigo Telefono País</label>
                <input class="form-control" id="codigoTelefono" type="text" name="codigoTelefono"
                    value="{{ old('codigoTelefono') }}" placeholder="Ingrese Codigo Telefono País...">
            </div>
            <button class="btn btn-primary" type="submit">Agregar</button>
        </form>
    </div>
</div>
@endsection