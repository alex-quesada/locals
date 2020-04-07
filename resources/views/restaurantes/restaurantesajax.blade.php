@extends('master')

@section('content')
<h3>Local</h3>
<p>Se agregan locales con sus respectivos datos (Recuerde haber agregado: países, ciudades antes de ingresar un local)</p>
<hr>
<div class="row">

    <div class="col-md-12 mb-3">
        <form>
            <div class="form-row justify-content-center col-md-11">
                <div class="form-group col-md-2" id="idRestaurante">
                    <label>ID:</label>
                    <input type="text" id="myid" class="form-control" readonly='readonly'>
                </div>
                <div class="form-group col-md-5">
                    <label>Direccion</label>
                    <input type="teSxt" id="direccionUno" class="form-control">
                </div>
                <div class="form-group col-md-4" id="selecPais">
                    <label>País</label>
                    <select id="sel_pais" class="form-control" onchange="cambiaCiudad()">
                    </select>
                </div>
                <div class="form-group col-md-4" id="selecCiudad">
                    <label>Ciudad</label>
                    <select id="sel_ciudad" class="form-control">
                    </select>
                </div>
                <div class="form-row justify-content-center col-md-11">
                    <div class="form-group col-md-3" id="telefono">
                        <label>#Telefono</label>
                        <input type="text" id="numeroTelefono" class="form-control">
                    </div>
                    <div class="form-group col-md-2" id="botonAgregarTelefono">
                        <label>Otro</label>
                        <button onclick="otroTelefono()" type="button" class="btn btn-primary form-control"
                            id="agregarTelefono">Add</button>
                    </div>
                    <div class="form-group col-md-2 center" id="botonActualizar">
                        <button onclick="storeTel()" type="button" class="btn btn-primary form-control"
                            id="masTelefonos">Agregar</button>
                        <button onclick="updateTel()" type="button" class="btn btn-warning form-control mt-2"
                            id="actualizarTelefono">Actualizar</button>
                    </div>
                    <div id="telefonoesArea" class="form-group col-md-4" id="botonAgregarTelefono">
                        <label>Telefonos</label>
                        <textarea id="telefonosAgregados" cols="42" rows="3" readonly="readonly"></textarea>
                    </div>
                    <table id="datatable1" class="table table-bordered table-striped table-sm" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr>
                                <th scope="col" class="th-sm">Numero</th>
                                <th scope="col" class="th-sm">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id='telefonos'></tbody>
                    </table>
                </div>
            </div>
            <div class="form-row col-md-11 justify-content-center">
                <button type="button" id="save" onclick="saveData()" class="btn btn-primary mt-2">Agregar</button>
                <button type="button" id="update" onclick="updateData()" class="btn btn-warning mt-2">Actualizar /
                    Cancelar</button>
            </div>
        </form>
        <hr>
    </div>
    <div class="col-md-12">
        <input class="form-control col-md-3" id="myInput" type="text" placeholder="Buscar..">
        <table id="datatable" class="table table-bordered table-striped table-sm" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">ID</th>
                    <th class="th-sm">Direccion</th>
                    <th class="th-sm">Ciudad</th>
                    <th class="th-sm">País</th>
                    <th class="th-sm">Telefonos</th>
                    <th class="th-sm">Acciones</th>
                </tr>
            </thead>
            <tbody id='filter'></tbody>
        </table>
        <hr>
    </div>
</div>
@endsection

@section('footer-script')
<script type="text/javascript" src="{{ asset('js/restaurantes.js') }}">
</script>
@endsection