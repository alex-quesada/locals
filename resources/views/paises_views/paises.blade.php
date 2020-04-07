@extends('master');

@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div class="row">
    <div class="col-md-6">
        <h3>Países</h3>
    </div>
    <div class="col-md-4">
        <form action="/search" method="get">
            <div class="input-group">
                <input id="search" type="search" name="search" class="form-control">
                <span class="input-group-prepend">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </span>
            </div>
        </form>
    </div>
    <div class="col-md-2 text-right">
        <a href="{{ action('PaisController@create') }}" class="btn btn-primary">Agregar País</a>
    </div>
</div>
<form method="POST">
    @csrf
    @method('DELETE')
    <button formaction="/deleteall" type="submit" class="btn btn-danger">Borrar Seleccionados</button>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><input type="checkbox" class="selectall"></th>
                <th>País</th>
                <th>Continente</th>
                <th>Codigo Telefono</th>
                <th width="230">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paises as $pais)
            <tr>
                <td><input type="checkbox" name="ids[]" class="selectbox" value="{{ $pais->id_pais }}"></td>
                <td>{{ $pais->nombre_pais }}</td>
                <td>{{ $pais->continente_pais }}</td>
                <td>{{ $pais->codigo_pais }}</td>
                <td>
                    <a href="{{ action('PaisController@show', $pais->id_pais) }}" class="btn btn-info">Mostrar</a>
                    <a href="{{ action('PaisController@edit', $pais->id_pais) }}" class="btn btn-warning">Editar</a>
                    <button formaction="{{ action('PaisController@destroy', $pais->id_pais) }}" type="submit"
                        class="btn btn-danger">Eliminar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</form>
{{ $paises->links() }}
@endsection
@section('footer-script')
<script>
    $(".selectall").click(function() {
    $(".selectbox").prop("checked", $(this).prop("checked"));
});

$(".selectbox").change(function() {
    var total = $(".selectall").length;
    var number = $(".selectbox:checked").length;
    if (total == number) {
        $(".selectall").prop("checked", true);
    } else {
        $(".selectall").prop("checked", false);
    }
});
</script>
@endsection