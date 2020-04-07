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
        @foreach ($paises as $pais)
        <form action="{{ action('PaisController@update', $pais->id_pais) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombrePais">Nombre País</label>
                <input class="form-control" id="nombrePais" type="text" name="nombrePais"
                    value="{{ $pais->nombre_pais }}" placeholder="Ingrese Nombre País...">
            </div>
            <div class="form-group">
                <label for="continentePais">Continente País</label>
                <input class="form-control" id="continentePais" type="text" name="continentePais"
                    value="{{ $pais->continente_pais}}" placeholder="Ingrese Continente País...">
            </div>
            <div class="form-group">
                <label for="codigoTelefono">Codigo Telefono País</label>
                <input class="form-control" id="codigoTelefono" type="text" name="codigoTelefono"
                    value="{{ $pais->codigo_pais }}" placeholder="Ingrese Codigo Telefono País...">
            </div>
            <button class="btn btn-warning" type="submit">Actualizar</button>
            <a href="{{ action('PaisController@index') }}" class="btn btn-default">Regresar</a>
        </form>
        @endforeach
    </div>
</div>
@endsection