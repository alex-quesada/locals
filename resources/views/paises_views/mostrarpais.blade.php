@extends('master');

@section('content')
<div class="card offset-md-4" style="width: 350px">
    @foreach ($paises as $pais)
    <img class="card-img-top" src="http://via.placeholder.com/350x150?text={{ $pais->nombre_pais }}" />
    <div class="card-body text-center">
        <div class="card-title">Contiente: {{ $pais->continente_pais }}</div>
        <p class="card-text">Codigo Telefónico: {{ $pais->codigo_pais }}</p>
        <a href="{{ action('PaisController@index') }}" class="btn btn-primary">Regresar</a>
    </div>
    @endforeach
</div>
@endsection